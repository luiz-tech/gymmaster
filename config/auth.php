<?php

return [

    'defaults' => [
        'guard' => 'web',
        'passwords' => 'pessoas',
    ],

    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'pessoas',
        ],
    ],  

    'providers' => [
        'pessoas' => [
            'driver' => 'eloquent',
            'model' => App\Models\Pessoas::class,
        ],
    ],

    'passwords' => [
        'pessoas' => [
            'provider' => 'pessoas',
            'table' => 'password_resets',
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    'password_timeout' => 10800,

];

