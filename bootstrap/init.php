<?php

use Core\Database;
use Core\App;
use App\Repositories\PostRepository;
use App\Services\PostService;

require base_path('App/Services/PostService.php');

$config = require base_path('config.php');

App::bind(
    Database::class,
    new Database($config['db'])
);

App::bind(
    PostRepository::class,
    new PostRepository(
        App::resolve(Database::class)
));

App::bind(
    PostService::class,
    new PostService()
);
