<?php

namespace App;

use Laravel\Socialite\Contracts\Provider;
use Mail;

class SocialAccountService
{
    public function createOrGetUser(Provider $provider)
    {

        $providerUser = $provider->user();
        $providerName = class_basename($provider);

        $account = SocialAccount::whereProvider($providerName)
            ->whereProviderUserId($providerUser->getId())
            ->first();

        if ($account) {
            return $account->user;
        } else {

            $account = new SocialAccount([
                'provider_user_id' => $providerUser->getId(),
                'provider' => $providerName
            ]);

            $user = User::where('email_address',$providerUser->getEmail())->first();

            if (!$user) {

                $user = User::create([
                    'email_address' => $providerUser->getEmail(),
                    'name' => $providerUser->getName(),
                ]);
                
                Mail::send('emails.registration', $user, function($mail) use ($user) {
                    $mail->to($user->email, $user->name)->subject("Web Pay Phone Registration");
                });
            }



            $account->user()->associate($user);
            $account->save();

            return $user;

        }

    }
}