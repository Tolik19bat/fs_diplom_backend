<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Имя приложения
    |--------------------------------------------------------------------------
    |
    | Это значение — имя вашего приложения, которое будет использоваться, когда
    | фреймворку необходимо поместить имя приложения в уведомление или
    | другие элементы пользовательского интерфейса, где необходимо отобразить имя приложения.
    |
    */

    'name' => env('APP_NAME', 'Laravel'),

    /*
    |--------------------------------------------------------------------------
    | Среда приложения
    |--------------------------------------------------------------------------
    |
    | Это значение определяет «среду», в которой в данный момент
    | работает ваше приложение. Это может определить, как вы предпочитаете настраивать различные
    | службы, используемые приложением. Установите это в вашем файле «.env».
    |
    */

    'env' => env('APP_ENV', 'production'),

    /*
    |--------------------------------------------------------------------------
    | Режим отладки приложения
    |--------------------------------------------------------------------------
    |
    | Когда приложение находится в режиме отладки, подробные сообщения об ошибках с
    | трассировкой стека будут отображаться для каждой ошибки, которая возникает в вашем
    | приложении. Если отключено, отображается простая общая страница с ошибкой.
    |
    */

    'debug' => (bool) env('APP_DEBUG', false),

    /*
    |--------------------------------------------------------------------------
    | URL приложения
    |--------------------------------------------------------------------------
    |
    | Этот URL используется консолью для правильной генерации URL при использовании
    | инструмента командной строки Artisan. Вам следует установить его в корне
    | приложения, чтобы он был доступен в командах Artisan.
    |
    */

    'url' => env('APP_URL', 'http://localhost'),

    /*
    |-------------------------------------------------------------------------
    | Часовой пояс приложения
    |-------------------------------------------------------------------------
    |
    | Здесь вы можете указать часовой пояс по умолчанию для вашего приложения, который
    | будет использоваться функциями даты и даты-времени PHP. Часовой пояс
    | по умолчанию установлен на «UTC», так как он подходит для большинства случаев использования.
    |
    */

    'timezone' => env('APP_TIMEZONE', 'UTC'),

    /*
    |-------------------------------------------------------------------------
    | Конфигурация локали приложения
    |--------------------------------------------------------------------------
    |
    | Локаль приложения определяет локаль по умолчанию, которая будет использоваться
    | методами перевода/локализации Laravel. Этот параметр можно
    | установить на любую локаль, для которой вы планируете иметь строки перевода.
    |
    */

    'locale' => env('APP_LOCALE', 'en'),

    'fallback_locale' => env('APP_FALLBACK_LOCALE', 'en'),

    'faker_locale' => env('APP_FAKER_LOCALE', 'en_US'),

    /*
    |--------------------------------------------------------------------------
    | Ключ шифрования
    |--------------------------------------------------------------------------
    |
    | Этот ключ используется службами шифрования Laravel и должен быть установлен
    | на случайную строку из 32 символов, чтобы гарантировать, что все зашифрованные значения
    | защищены. Это следует сделать до развертывания приложения.
    |
    */

    'cipher' => 'AES-256-CBC',

    'key' => env('APP_KEY'),

    'previous_keys' => [
        ...array_filter(
            explode(',', env('APP_PREVIOUS_KEYS', ''))
        ),
    ],

    /*
    |--------------------------------------------------------------------------
    | Драйвер режима обслуживания
    |--------------------------------------------------------------------------
    |
    | Эти параметры конфигурации определяют драйвер, используемый для определения и
    | управления статусом «режима обслуживания» Laravel. Драйвер «cache»
    | позволит управлять режимом обслуживания на нескольких машинах.
    |
    | Поддерживаемые драйверы: «file», «cache»
    |
    */

    'maintenance' => [
        'driver' => env('APP_MAINTENANCE_DRIVER', 'file'),
        'store' => env('APP_MAINTENANCE_STORE', 'database'),
    ],

];
