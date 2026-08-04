<?php

//Public

$router->get('/', 'App/Controllers/index.php');
$router->get('/posts', 'App/Controllers/posts.php');
$router->get('/post', 'App/Controllers/post.php');

//AUTH 

$router->get('/posts/create', 'App/Controllers/posts-create.php')->only('auth');
$router->get('/post/edit', 'App/Controllers/post-edit.php')->only('auth');

$router->post('/posts', 'App/Controllers/posts-store.php')->only('auth');
$router->post('/logout', 'App/Controllers/logout.php')->only('auth');

$router->patch('/post', 'App/Controllers/post-update.php')->only('auth');

$router->delete('/post', 'App/Controllers/post-delete.php')->only('auth');

//GUEST

$router->get('/login', 'App/Controllers/login.php')->only('guest');
$router->post('/login', 'App/Controllers/login-store.php')->only('guest');


