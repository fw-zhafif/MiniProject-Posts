<?php

namespace App\Services;

use App\Repositories\PostRepository;
use App\Validation\PostValidator;
use Core\App;
use Core\Rules;

class PostService
{
    protected PostRepository $posts;

    public function __construct()
    {
        $this->posts = App::resolve(PostRepository::class);
    }

    public function all() {
        return $this->posts->all();
    }

    public function create(array $attributes) 
    {
        $data = PostValidator::validate($attributes);
        $this->posts->create($data);
    }

    public function update($id, array $attributes)
    {
        $data = PostValidator::validate($attributes);

        $this->posts->update($id, $data);
    }

    public function destroy($id)
    {
        if (! Rules::required($id)) {
            abort();
        }

        $this->posts->find($id);
    }

    public function find($id)
    {
    if (! Rules::required($id)) {
        abort();
    }

    $post = $this->posts->find($id);

    if (! $post) {
        abort();
    }

    return $post;
    }

}