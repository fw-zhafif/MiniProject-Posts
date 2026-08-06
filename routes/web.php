<?php

use App\Controllers\PostController;
use App\Controllers\AuthController;
use App\Controllers\HomeController;

//Public

$router->get('/', [HomeController::class, 'index']);

$router->get('/posts', [
    PostController::class,
    'index'
]);

$router->get('/post', [PostController::class, 'show']);

//AUTH 

$router->get('/posts/create', [PostController::class, 'create']);;
$router->get('/post/edit', [PostController::class, 'edit']);

$router->post('/posts', [PostController::class, 'store']);
$router->post('/logout', [AuthController::class, 'logout'])->only('auth');

$router->patch('/post', [PostController::class, 'update']);

$router->delete('/post', [PostController::class, 'destroy']);

//GUEST

$router->get('/login', [AuthController::class, 'create'])->only('guest');
$router->post('/login', [AuthController::class, 'store'])->only('guest');


