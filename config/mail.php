<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Почтовая программа по умолчанию
    |-------------------------------------------------------------------------
    |
    | Эта опция управляет почтовой программой по умолчанию, которая используется для отправки всех сообщений электронной почты,
    | если при отправке сообщения явно не указана другая почтовая программа. Все дополнительные почтовые программы можно настроить в массиве
    | "mailers". Приведены примеры каждого типа почтовой программы.
    |
    */

    'default' => env('MAIL_MAILER', 'log'),

    /*
    |--------------------------------------------------------------------------
    | Конфигурации почтовых программ
    |--------------------------------------------------------------------------
    |
    | Здесь вы можете настроить все почтовые программы, используемые вашим приложением, а также
    | их соответствующие настройки. Несколько примеров были настроены для
    | вас, и вы можете добавлять свои собственные, как того требует ваше приложение.
    |
    | Laravel поддерживает множество почтовых «транспортных» драйверов, которые можно использовать
    | при доставке электронной почты. Ниже вы можете указать, какой из них вы используете для
    | ваших почтовых программ. При необходимости вы также можете добавить дополнительные почтовые программы.
    |
    | Поддерживаются: «smtp», «sendmail», «mailgun», «ses», «ses-v2»,
    | «postmark», «resend», «log», «array»,
    | «failover», «roundrobin»
    |
    */

    'mailers' => [

        'smtp' => [
            'transport' => 'smtp',
            'url' => env('MAIL_URL'),
            'host' => env('MAIL_HOST', '127.0.0.1'),
            'port' => env('MAIL_PORT', 2525),
            'encryption' => env('MAIL_ENCRYPTION', 'tls'),
            'username' => env('MAIL_USERNAME'),
            'password' => env('MAIL_PASSWORD'),
            'timeout' => null,
            'local_domain' => env('MAIL_EHLO_DOMAIN', parse_url(env('APP_URL', 'http://localhost'), PHP_URL_HOST)),
        ],

        'ses' => [
            'transport' => 'ses',
        ],

        'postmark' => [
            'transport' => 'postmark',
            // 'message_stream_id' => env('POSTMARK_MESSAGE_STREAM_ID'),
            // 'client' => [
            //     'timeout' => 5,
            // ],
        ],

        'resend' => [
            'transport' => 'resend',
        ],

        'sendmail' => [
            'transport' => 'sendmail',
            'path' => env('MAIL_SENDMAIL_PATH', '/usr/sbin/sendmail -bs -i'),
        ],

        'log' => [
            'transport' => 'log',
            'channel' => env('MAIL_LOG_CHANNEL'),
        ],

        'array' => [
            'transport' => 'array',
        ],

        'failover' => [
            'transport' => 'failover',
            'mailers' => [
                'smtp',
                'log',
            ],
        ],

        'roundrobin' => [
            'transport' => 'roundrobin',
            'mailers' => [
                'ses',
                'postmark',
            ],
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Глобальный адрес «От»
    |--------------------------------------------------------------------------
    |
    | Вы можете захотеть, чтобы все письма, отправленные вашим приложением, были отправлены с
    | одного и того же адреса. Здесь вы можете указать имя и адрес, которые
    | используются глобально для всех писем, отправленных вашим приложением.
    |
    */

    'from' => [
        'address' => env('MAIL_FROM_ADDRESS', 'hello@example.com'),
        'name' => env('MAIL_FROM_NAME', 'Example'),
    ],

];
