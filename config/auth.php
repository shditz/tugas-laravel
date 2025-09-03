<?php

return [

    'defaults' => [
        'guard' => env('AUTH_GUARD', 'web'),
        'passwords' => env('AUTH_PASSWORD_BROKER', 'users'),
    ],

    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'users',  // pastikan provider ada di bawah
        ],
        'user' => [
            'driver' => 'session',
            'provider' => 'logins',  // pastikan provider ini juga ada jika dipakai
        ],
        'login' => [
            'driver' => 'session',
            'provider' => 'logins',  // provider yang pakai model Login
        ],
    ],

    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => App\Models\User::class,
        ],
        'logins' => [
            'driver' => 'eloquent',
            'model' => App\Models\Login::class,
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
