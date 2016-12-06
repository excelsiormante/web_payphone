<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\SocialAccountService;
use Socialite, Session, Crypt, Mail; 

class SocialAuthController extends Controller
{
    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function callback(SocialAccountService $service, $provider)
    {
        // Important change from previous post is that I'm now passing
        // whole driver, not only the user. So no more ->user() part
        $user = $service->createOrGetUser(Socialite::driver($provider));

        Mail::send('registration.test', $user, function($mail) use ($user) {
            $mail->to($user->email, $user->name)->subject("Web Pay Phone Registration");
        });
        
        auth()->login($user);

        Session::put('subscriber_id', Crypt::encrypt($user->id));
        Session::put('name',$user->name);
        Session::put('email', $user->email);
        Session::put('archer_account_id',$user->archer_account_id);

        
        return redirect()->to('app');
    }
}   
