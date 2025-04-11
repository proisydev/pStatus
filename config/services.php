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

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'resend' => [
        'key' => env('RESEND_KEY'),
    ],

    'slack' => [
        'notifications' => [
            'bot_user_oauth_token' => env('SLACK_BOT_USER_OAUTH_TOKEN'),
            'channel' => env('SLACK_BOT_USER_DEFAULT_CHANNEL'),
        ],
    ],

    'api_status' => [
        'url' => env('API_STATUS_URL'),
        'get' => [
            'api' => [
                "monitors" => env('API_STATUS_URL') . '/api/monitors',
                "account-details" => env('API_STATUS_URL') . '/api/account-details',
                "public-pages" => env('API_STATUS_URL') . '/api/public-pages',
                "specific-monitor" => env('API_STATUS_URL') . '/api/monitors/{page_id}/{monitor_id}',
                "clear-cache" => env('API_STATUS_URL') . '/api/clear-cache',
            ],
            "health" => env('API_STATUS_URL') . '/health',
            "metrics" => env('API_STATUS_URL') . '/metrics',
        ]
    ]

];
