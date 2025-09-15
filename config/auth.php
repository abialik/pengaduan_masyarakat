<?php

return [

    'defaults' => [
        'guard' => env('AUTH_GUARD', 'web'),
        'passwords' => env('AUTH_PASSWORD_BROKER', 'users'),
    ],

    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'users', // default user biasa
        ],

        'masyarakat' => [
            'driver' => 'session',
            'provider' => 'masyarakat', // ✅ harus sama dengan providers
        ],
        'admin' => [
            'driver' => 'session',
            'provider' => 'petugas', // ✅ harus sama dengan providers
        ],
        'petugas' => [
            'driver' => 'session',
            'provider' => 'petugas', // gunakan provider petugas
        ],
    ],

'providers' => [
    'users' => [
        'driver' => 'eloquent',
        'model' => App\Models\User::class,
    ],

    'masyarakat' => [
        'driver' => 'eloquent',
        'model' => App\Models\Masyarakat::class,
    ],

    'petugas' => [
        'driver' => 'eloquent',
        'model' => App\Models\Petugas::class, // gunakan model Petugas
    ],
],

    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => env('AUTH_PASSWORD_RESET_TOKEN_TABLE', 'password_reset_tokens'),
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    'password_timeout' => env('AUTH_PASSWORD_TIMEOUT', 10800),
];
