<?php

$repository = App::resolve(PostRepository::class);
$posts = $repository->all();

require "views/posts.view.php";
