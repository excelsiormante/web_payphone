<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, Mandrill, and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'mandrill' => [
        'secret' => env('MANDRILL_SECRET'),
    ],

    'ses' => [
        'key'    => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'stripe' => [
        'model'  => App\User::class,
        'key'    => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],

    'facebook' => [
        'client_id' => '321220418254424',
        'client_secret' => '20a84b41362331a4f120843128f67207',
        'redirect' => env('FB_REDIRECT', 'forge'),
    ],

    'google' => [
    'client_id' => '239345370395-r9neas43vf97ujoma56dnd66pjpmlj1c.apps.googleusercontent.com',
    'client_secret' => 'd5nTbiWQyu-7t5iWIHyY_fTF',
    'redirect' => env('GOOGLE_REDIRECT', 'forge'),
    ],


    'linkedin' => [
    'client_id' => '81z08m1e2pjw6l',
    'client_secret' => '8Dprt6t47qtutcfl',
    'redirect' => env('LINKEDIN_REDIRECT', 'forge'),
    ],

];
