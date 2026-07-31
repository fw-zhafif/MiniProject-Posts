<?php

$router->get('/', 'controllers/index.php');
$router->get('/posts', 'controllers/posts.php');
$router->get('/post', 'controllers/post.php');
$router->get("/posts/create", "controllers/posts-create.php");
$router->get("/post/edit", "controllers/post-edit.php");

$router->post('/posts', 'controllers/posts-store.php');
$router->patch('/post', 'controllers/post-update.php');

        

?>