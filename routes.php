<?php
    return [
        'GET' => [
            "/" => "controllers/index.php",
            "/posts" => "controllers/posts.php",
            "/post" => "controllers/post.php",
            "/posts/create" => "controllers/posts-create.php"
        ],
        
        'POST' => [
            "/posts" => "controllers/posts-store.php"
        ]
        
    ];
?>