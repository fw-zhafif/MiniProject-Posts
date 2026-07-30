<?php

$config = require 'config.php';
$db = new Database($config['db']);
$id = $_GET['id'];

$post = $db->query('select * from posts where id= :id', [
    'id' => $id
])->find();

if (! $post) {
    abort();
}

require 'views/post-edit.view.php';

