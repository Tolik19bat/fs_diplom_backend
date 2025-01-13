<?php  

return [  

    /*  
    |--------------------------------------------------------------------------  
    | Cross-Origin Resource Sharing (CORS) Configuration  
    |--------------------------------------------------------------------------  
    |  
    | Here you may configure your settings for cross-origin resource sharing  
    | or "CORS". This determines what cross-origin operations may execute  
    | in web browsers. You are free to adjust these settings as needed.  
    |  
    | To learn more: https://developer.mozilla.org/en-US/docs/Web/HTTP/CORS  
    |  
    */  

    // Путь к API, для которого разрешены CORS  
    'paths' => ['api/*'],  

    // Разрешенные методы  
    'allowed_methods' => ['*'], // Разрешить все методы, или перечислите необходимые (GET, POST и т.д.)  

    // Разрешенные источники  
    'allowed_origins' => ['*'], // Разрешить все источники, или перечислите необходимые  

    // Разрешенные источники по шаблону  
    'allowed_origins_patterns' => [], // Обычно оставляют пустым, если не нужно использовать паттерны  

    // Разрешенные заголовки  
    'allowed_headers' => ['*', 'authorization', 'Content-Type'], // с проверкой 'authorization' и 'Content-Type' что бы правильно были написаны 

    // Экспонируемые заголовки  
    'exposed_headers' => [], // Если необходимо экспонировать заголовки, укажите их  

    // Максимальное время кэширования  
    'max_age' => 0, // Параметр в секундах для кэширования результатов предварительных запросов  

    // Поддержка куки и авторизация  
    'supports_credentials' => false, // Установите в true, если куки и авторизация необходимы  

]; 
