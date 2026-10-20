<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | Menyimpan layanan pihak ketiga yaitu qris nya itu tadi
    */
    'qris' => [
        'base_url' => env('QRIS_BASE_URL'),
        'token' => env('QRIS_TOKEN'),
    ],
];
