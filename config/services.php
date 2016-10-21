<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],
    'github' => [
        'client_id' => 'df337e45e3d155eabb60',//github id nhe
        'client_secret' => 'aa4334c96ea87f6eb15aa70afeae6abbbd4795ef',//github secret
        'redirect' => 'http://localhost:8000/github/callback',//duong dan dang nhap
    ],

    'facebook' => [
        'client_id' => '183970218676569',//app id
        'client_secret' => '9d438e0ce8008cd5be764fe982f24e97',//ap secret
        'redirect' => 'http://localhost:8000/facebook/callback',
    ],

    'google' => [
        'client_id' => '951347144313-0pepktiuo9igstgvprnmpt3cgn8p91d8.apps.googleusercontent.com',//app id
        'client_secret' => '8MOqz9GOqs-9ISthILfM_bx2',//ap secret
        'redirect' => 'http://localhost:8000/google/callback',
    ]

];
