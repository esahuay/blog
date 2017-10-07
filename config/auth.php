<?php

return [

    'multi' => [
        'user' => [
            'driver' => 'eloquent',
            'model'  => App\User::class,
            'table'  => 'users'
        ],
        'student' => [
            'driver' => 'eloquent',
            'model'  => App\Student::class,
            'table'  => 'students'
        ]
    ],

    'password' => [
        'email'  => 'emails.password',
        'table'  => 'password_resets',
        'expire' => 60,
    ],

];
