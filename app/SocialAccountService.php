<?php

namespace App;

use Laravel\Socialite\Contracts\Provider;

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
                    'status' => 1
                ]);
            }



            $account->user()->associate($user);
            $account->save();

            return $user;

        }

    }
}