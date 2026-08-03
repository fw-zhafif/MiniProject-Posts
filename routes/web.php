<?php

//Public

$router->get('/', 'controllers/index.php');
$router->get('/posts', 'controllers/posts.php');
$router->get('/post', 'controllers/post.php');

//AUTH 

$router->get('/posts/create', 'controllers/posts-create.php')->only('auth');
$router->get('/post/edit', 'controllers/post-edit.php')->only('auth');

$router->post('/posts', 'controllers/posts-store.php')->only('auth');
$router->post('/logout', 'controllers/logout.php')->only('auth');

$router->patch('/post', 'controllers/post-update.php')->only('auth');


//GUEST

$router->get('/login', 'controllers/login.php')->only('guest');
$router->post('/login', 'controllers/login-store.php')->only('guest');


