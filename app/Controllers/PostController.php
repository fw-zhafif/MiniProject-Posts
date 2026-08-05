<?php

class PostController extends Controller
{
    protected PostRepository $posts;

    public function __construct()
    {
        $this->posts = $this->resolve(PostRepository::class);
    }

    public function index()
    {
        $posts = $this->posts->all();

        $this->view('posts.index', [
            'posts' => $posts,
            'title' => 'Posts'
        ]);
    }
    
    public function show()
    {
        $id = Request::input('id');

        if (! Rules::required($id)) {
            abort();
        }

        $post = $this->posts->find($id);

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

        $data = PostValidator::validate($data);

        $this->posts->create($data);

        redirect('/posts');

    }

    public function edit()
    {
        $id = Request::input('id');
        $post = $this->posts->find($id);

        if (! $post) {
            abort();
        }

        $this->view('posts.edit', [
            'post' => $post,
            'title' => 'Edit Post'
        ]);
    }

    public function update()
    {
        
        $id = Request::input('id');

        $data = [
        'title' => trim(Request::input('title')),
        'body'  => trim(Request::input('body'))
        ];

        $data = PostValidator::validate($data);

        $this->posts->update($id, $data);

        redirect("/post?id={$id}");
    }

    public function destroy()
    {      
        $id = Request::input('id');

        if (! Rules::required($id)) 
        {
            abort();
        }

        $this->posts->find($id);

        $this->posts->delete($id);;

        redirect('/posts');
    }
}