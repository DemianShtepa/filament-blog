<?php

return [
    'route' => [
        'prefix' => 'blog',
        'middleware' => ['web'],
        'login' => [
            'name' => 'filament.admin.auth.login',
        ],
    ],
    'user' => [
        'model' => \App\Models\User::class,
        'foreign_key' => 'user_id',
        'columns' => [
            'name' => 'name',
            'avatar' => 'profile_photo_path',
        ],
    ],
];
