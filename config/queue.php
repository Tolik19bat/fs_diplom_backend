<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Имя соединения очереди по умолчанию
    |--------------------------------------------------------------------------
    |
    | Очередь Laravel поддерживает множество бэкендов через единый, унифицированный
    | API, предоставляя вам удобный доступ к каждому бэкенду с использованием
    | одинакового синтаксиса для каждого. Соединение очереди по умолчанию определено ниже.
    |
    */

    'default' => env('QUEUE_CONNECTION', 'database'),

    /*
    |--------------------------------------------------------------------------
    | Подключения к очередям
    |--------------------------------------------------------------------------
    |
    | Здесь вы можете настроить параметры подключения для каждого бэкенда очереди
    | используемого вашим приложением. Пример конфигурации предоставляется для
    | каждого бэкенда, поддерживаемого Laravel. Вы также можете добавить больше.
    |
    | Драйверы: "sync", "database", "beanstalkd", "sqs", "redis", "null"
    |
    */

    'connections' => [

        'sync' => [
            'driver' => 'sync',
        ],

        'database' => [
            'driver' => 'database',
            'connection' => env('DB_QUEUE_CONNECTION'),
            'table' => env('DB_QUEUE_TABLE', 'jobs'),
            'queue' => env('DB_QUEUE', 'default'),
            'retry_after' => (int) env('DB_QUEUE_RETRY_AFTER', 90),
            'after_commit' => false,
        ],

        'beanstalkd' => [
            'driver' => 'beanstalkd',
            'host' => env('BEANSTALKD_QUEUE_HOST', 'localhost'),
            'queue' => env('BEANSTALKD_QUEUE', 'default'),
            'retry_after' => (int) env('BEANSTALKD_QUEUE_RETRY_AFTER', 90),
            'block_for' => 0,
            'after_commit' => false,
        ],

        'sqs' => [
            'driver' => 'sqs',
            'key' => env('AWS_ACCESS_KEY_ID'),
            'secret' => env('AWS_SECRET_ACCESS_KEY'),
            'prefix' => env('SQS_PREFIX', 'https://sqs.us-east-1.amazonaws.com/your-account-id'),
            'queue' => env('SQS_QUEUE', 'default'),
            'suffix' => env('SQS_SUFFIX'),
            'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
            'after_commit' => false,
        ],

        'redis' => [
            'driver' => 'redis',
            'connection' => env('REDIS_QUEUE_CONNECTION', 'default'),
            'queue' => env('REDIS_QUEUE', 'default'),
            'retry_after' => (int) env('REDIS_QUEUE_RETRY_AFTER', 90),
            'block_for' => null,
            'after_commit' => false,
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Пакетирование заданий
    |--------------------------------------------------------------------------
    |
    | Следующие параметры настраивают базу данных и таблицу, в которых хранится информация о пакетировании заданий. Эти параметры можно обновить для любого подключения к базе данных
    | и таблицы, которые определены вашим приложением.
    |
    */

    'batching' => [
        'database' => env('DB_CONNECTION', 'sqlite'),
        'table' => 'job_batches',
    ],

    /*
    |--------------------------------------------------------------------------
    | Невыполненные задания очереди
    |--------------------------------------------------------------------------
    |
    | Эти параметры настраивают поведение журнала невыполненных заданий очереди, чтобы вы
    | могли контролировать, как и где хранятся невыполненные задания. Laravel поставляется с
    | поддержкой хранения невыполненных заданий в простом файле или в базе данных.
    |
    | Поддерживаемые драйверы: "database-uuids", "dynamodb", "file", "null"
    |
    */

    'failed' => [
        'driver' => env('QUEUE_FAILED_DRIVER', 'database-uuids'),
        'database' => env('DB_CONNECTION', 'sqlite'),
        'table' => 'failed_jobs',
    ],

];
