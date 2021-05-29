<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],
    'google' => [
        'client_id'     => '612023788074-rijj6nrl5kn7giltkubh5q5k6fn0uj9s.apps.googleusercontent.com',
        'client_secret' => 'NTmBtNrkrVNVWwTu-O9heHbD',
        'redirect'      => env('APP_URL') . '/oauth/google/callback',
    ],
    'facebook' => [
        'client_id'     => "373579237103825",
        'client_secret' => "b9fc742758f5d72d5c2a6f752ebaa4e9",
        'redirect'      => env('APP_URL') . '/oauth/facebook/callback',
    ]
];
