<?php

$config = require 'config.php';
$db = new Database($config['db']);

$id = $_POST['id'];
$title = $_POST['title'];
$body = $_POST['body'];

$db->query('update posts set title= :title, body= :body where id= :id', [
    'id' => $id,
    'title' => $title,
    'body' => $body
]);

redirect("/post?id={$id}");