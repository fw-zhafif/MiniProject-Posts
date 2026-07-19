<?php

    $config = require "config.php";
    $db = new Database($config['db']);
    $id = $_GET['id'];

    if (! isset($id)) {
        abort();
    }

    $post = $db->query("SELECT * FROM posts WHERE id = :id",
    ['id' => $id]
    )->findOrFail();

    require "views/post.view.php"
?>