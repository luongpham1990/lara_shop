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

    'google' => [
        'client_id' => '951347144313-0pepktiuo9igstgvprnmpt3cgn8p91d8.apps.googleusercontent.com',
        'client_secret' => '8MOqz9GOqs-9ISthILfM_bx2',
        'redirect' => 'http://localhost:8000/google/callback',
    ],

    'facebook' => [
        'client_id' => '183970218676569',
        'client_secret' => '9d438e0ce8008cd5be764fe982f24e97',
        'redirect' => 'http://localhost:8000/facebook/callback',
    ],

    'github' => [
        'client_id' => 'df337e45e3d155eabb60',
        'client_secret' => 'aa4334c96ea87f6eb15aa70afeae6abbbd4795ef',
        'redirect' => 'http://localhost:8000/github/callback',
    ],

];
