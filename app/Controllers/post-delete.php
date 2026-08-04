<?php

$id = Request::input('id');

if (! Validator::required($id)) 
{
    abort();
}

$repository = App::resolve(PostRepository::class);

$repository->find($id);

$repository->delete($id);;


redirect('/posts');

