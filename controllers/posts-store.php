<?php

$title = trim(Request::input('title'));
$body  = trim(Request::input('body'));

$errors = new ErrorBag;

if (! Validator::required($title)) {

    $errors->add('title','title is required');

} elseif (! Validator::min($title, 5)) {

    $errors->add('title', 'Minimal 5 karakter.');

} elseif (! Validator::max($title, 255)) {

    $errors->add('title','Maksimal 255 karakter.');
}

if (! Validator::required($body)) {

    $errors->add('body','body is required');

} elseif (! Validator::min($body, 20)) {

    $errors->add('body','Minimal 20 karakter.');
}

if (! $errors->isEmpty()) {

    Flash::set('errors', $errors);

    Flash::set('old', [
        'title' => $title,
        'body' => $body
    ]);

    redirect('/posts/create');
}

$config = require "config.php";
$db = new Database($config['db']);

$db->query("INSERT INTO posts (title,body)
VALUES (:title, :body)",
[
    'title' => $title,
    'body' => $body
]
);

redirect('/posts');
