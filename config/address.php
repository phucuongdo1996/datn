<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Config api address
    |--------------------------------------------------------------------------
    |
    | This URL is used by the console to properly generate URLs when using
    | the Artisan command line tool. You should set this to the root of
    | your application so that it is used when running Artisan tasks.
    |
    */
    'base_uri' => env('API_RESAS_BASE_URI', 'https://opendata.resas-portal.go.jp'),
    'x_api_key' => env('API_RESAS_KEY', 'OHFXZPHmJOyauqx7TT2fb7bKt4uoTOBiIDobxml4')
];
