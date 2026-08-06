<?php

use Core\Database;
use Core\App;
use App\Repositories\PostRepository;
use App\Services\PostService;

require base_path('App/Services/PostService.php');

$config = require base_path('config.php');

App::singleton(
    Database::class,
    function () use ($config) {
        return new Database($config['db']);
    }
);

// App::bind(
//     PostRepository::class,
//     function () {
//         return new PostRepository(
//             App::resolve(Database::class)
//         );
//     }
// );

// App::bind(
//     PostService::class,
//     function () {
//         return new PostService();
//     }
// );
