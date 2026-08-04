<?php

$id = Request::input('id');

if (! Validator::required($id)) {
    abort();
}

$repository = App::resolve(PostRepository::class);

$post = $repository->find($id);

view('post.view.php', [
    'post'  => $post,
    'title' => 'Detail Post'
]);
