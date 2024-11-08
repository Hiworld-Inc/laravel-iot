<?php

return [
    /*
    |--------------------------------------------------------------------------
    | 默认IoT平台
    |--------------------------------------------------------------------------
    |
    | 这里指定默认使用的IoT平台
    | 支持: "ctwing", "tuya", "xiaomi"
    |
    */
    'default' => env('IOT_DEFAULT_PROVIDER', 'ctwing'),

    /*
    |--------------------------------------------------------------------------
    | IoT平台配置
    |--------------------------------------------------------------------------
    |
    | 这里可以配置多个IoT平台的参数
    |
    */
    'providers' => [
        'ctwing' => [
            'base_url' => env('CTWING_BASE_URL', 'https://2000514878.api.ctwing.cn'),
            'time_url' => env('CTWING_TIME_URL', 'https://2000514878.api.ctwing.cn/echo'),
            'app_key' => env('CTWING_APP_KEY', ''),
            'app_secret' => env('CTWING_APP_SECRET', ''),
            
            // 可选的其他配置
            'timeout' => env('CTWING_TIMEOUT', 30),
            'ssl_verify' => env('CTWING_SSL_VERIFY', true),
        ],

        'tuya' => [
            'base_url' => env('TUYA_BASE_URL', 'https://openapi.tuya.com'),
            'app_key' => env('TUYA_APP_KEY', ''),
            'secret' => env('TUYA_SECRET', ''),
            'version' => env('TUYA_API_VERSION', 'v1.0'),
        ],

        'xiaomi' => [
            'base_url' => env('XIAOMI_BASE_URL', 'https://api.xiaomi.com'),
            'app_key' => env('XIAOMI_APP_KEY', ''),
            'secret' => env('XIAOMI_SECRET', ''),
            'version' => env('XIAOMI_API_VERSION', '1.0'),
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | 全局配置
    |--------------------------------------------------------------------------
    |
    | 这里可以设置一些所有平台共用的配置
    |
    */
    'global' => [
        'debug' => env('IOT_DEBUG', false),
        'log_channel' => env('IOT_LOG_CHANNEL', 'daily'),
        'cache' => [
            'enabled' => env('IOT_CACHE_ENABLED', true),
            'ttl' => env('IOT_CACHE_TTL', 3600),
        ],
    ],
];