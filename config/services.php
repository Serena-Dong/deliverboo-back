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
        'scheme' => 'https',
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],
    'braintree' => [
        'environment' => env('BT_ENVIRONMENT', 'sandbox'),
        'merchantId' => env('BT_MERCHANT_ID', 'fzbw7r3fc9t6rn2y'),
        'publicKey' => env('BT_PUBLIC_KEY', '5m5qxmfcnyc6ygph'),
        'privateKey' => env('BT_PRIVATE_KEY', '651e683751955a549720a9d3177717db'),
    ]

];
