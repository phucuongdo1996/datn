<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Config api pay_jp
    |--------------------------------------------------------------------------
    |
    | This URL is used by the console to properly generate URLs when using
    | the Artisan command line tool. You should set this to the root of
    | your application so that it is used when running Artisan tasks.
    |
    */
    'uri' => env('API_PAY_JP_URI', 'https://pay.jp'),
    // 'secret_key' => env('API_PAY_JP_SECRET_KEY', 'sk_test_6d009810b6ac1e6da663b8c4'),
    // 'public_key' => env('API_PAY_JP_PUBLIC_KEY', 'pk_test_d08a705ce80d57012b62906b')
    'secret_key' => env('API_PAY_JP_SECRET_KEY', 'sk_live_4352b3931dcddee2b817784accf9c03609208a69f21f5b6cc3b72a60'),
    'public_key' => env('API_PAY_JP_PUBLIC_KEY', 'pk_live_6a50d900b12191b728a4e37a')
];
