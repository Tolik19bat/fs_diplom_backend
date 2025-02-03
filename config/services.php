<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Сторонние сервисы
    |--------------------------------------------------------------------------
    |
    | Этот файл предназначен для хранения учетных данных для сторонних сервисов, таких как
    | Mailgun, Postmark, AWS и т. д. Этот файл предоставляет фактическое
    | местоположение для этого типа информации, позволяя пакетам иметь
    | обычный файл для поиска различных учетных данных сервиса.
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

];
