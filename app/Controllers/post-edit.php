<?php

$db = App::resolve(Database::class);

$id = $_GET['id'];
$repository = new PostRepository($db);

$post = $repository->find($id);

if (! $post) {
    abort();
}

require 'views/post-edit.view.php';

