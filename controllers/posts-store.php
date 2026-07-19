<?php
    $config = require "config.php";
    $db = new Database($config['db']);
    
    $title = $_POST['title'];
    $body = $_POST['body'];

    $db->query("INSERT INTO posts (title,body)
    VALUES (:title, :body)",
    [
        'title' => $title,
        'body' => $body
    ]
    );

    header('Location: /posts');
    die();
?>