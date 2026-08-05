<?php

//App
require base_path('Core/App.php');
require base_path('Core/ValidatorException.php');

// Controllers
require base_path('Core/Controller.php');
require base_path('App/Controllers/HomeController.php');
require base_path('App/Controllers/PostController.php');
require base_path('App/Controllers/AuthController.php');
require base_path('App/Validation/PostValidator.php');

require base_path('Core/Database.php');
require base_path('App/Repositories/PostRepository.php');


//Core
require base_path('Core/Router.php');
require base_path('Core/Request.php');
require base_path('Core/Rules.php');
require base_path('Core/ErrorBag.php');

//Middleware
require base_path('Core/MiddlewareManager.php');

require base_path('App/Middleware/AuthMiddleware.php');
require base_path('App/Middleware/GuestMiddleware.php');

$config = require base_path('config.php');

App::bind(
    Database::class,
    new Database($config['db'])
);

App::bind(
    PostRepository::class,
    new PostRepository(
        App::resolve(Database::class)
    )
);
