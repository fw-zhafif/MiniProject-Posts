<?php

    $config = require "config.php";
    $db = new Database($config['db']);
    
    if (! isset($_GET['id'])) {
        abort();
    }

    $post = $db->query("SELECT * FROM posts WHERE id = :id",
    ['id' => $_GET['id']]
    )->find();

    if ($post === false) {
        abort();
    }
    require "views/post.view.php"
?>