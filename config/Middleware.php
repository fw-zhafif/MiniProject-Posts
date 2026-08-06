<?php

use App\Middleware\AuthMiddleware;
use App\Middleware\GuestMiddleware;

return [
    'auth' => AuthMiddleware::class,
    'guest' => GuestMiddleware::class,
];