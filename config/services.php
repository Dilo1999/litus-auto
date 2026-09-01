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

    'brevo' => [
        'key' => env('BREVO_API_KEY'),
        'verify_ssl' => filter_var(
            env('BREVO_VERIFY_SSL', env('APP_ENV') !== 'local'),
            FILTER_VALIDATE_BOOLEAN
        ),
    ],

    'telegram' => [
        'bot_token' => env('TELEGRAM_BOT_TOKEN', env('TELEGRAM_PARTS_BOT_TOKEN')),
        'parts_chat_id' => env('TELEGRAM_PARTS_CHAT_ID'),
        'service_chat_id' => env('TELEGRAM_SERVICE_CHAT_ID'),
        'sales_chat_id' => env('TELEGRAM_SALES_CHAT_ID'),
        'verify_ssl' => filter_var(
            env('TELEGRAM_VERIFY_SSL', false),
            FILTER_VALIDATE_BOOLEAN
        ),
    ],

];
