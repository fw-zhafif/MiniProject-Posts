<?php

namespace App\Controllers;

use Core\Controller;
use Core\Request;
use Core\Rules;
use App\Repositories\PostRepository;
use App\Validation\PostValidator;
use App\Services\PostService;

class PostController extends Controller
{
    protected PostService $service;

    public function __construct(PostService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $posts = $this->service->all();

        $this->view('posts.index', [
            'posts' => $posts,
            'title' => 'Posts'
        ]);
    }
    
    public function show()
    {
        $id = Request::input('id');

        $post = $this->service->find($id);

        $this->view('posts.show', [
            'post' => $post,
            'title' => $post['title']
        ]);
    }

    public function create()
    {
        $this->view('posts.create', [
        'title' => 'Create Post'
        ]);
    }

    public function store()
    {

        $data = [
        'title' => trim(Request::input('title')),
        'body'  => trim(Request::input('body'))
        ];

        $this->service->create($data);

        redirect('/posts');

    }

    public function edit()
    {
        $id = Request::input('id');
        $post = $this->service->find($id);

        $this->view('posts.edit', [
            'post' => $post,
            'title' => 'Edit Post'
        ]);
    }

    public function update()
    {
        $id = Request::input('id');

        $attributes = [
            'title' => trim(Request::input('title')),
            'body'  => trim(Request::input('body'))
        ];

        $this->service->update($id, $attributes);

        redirect("/post?id={$id}");
    }

    public function destroy()
    {      
        $id = Request::input('id');

        $this->service->destroy($id);

        redirect('/posts');
    }

}