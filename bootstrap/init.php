<?php

//core
require base_path('core/Database.php');
require base_path('core/Router.php');
require base_path('core/Request.php');
require base_path('core/Validator.php');
require base_path('core/ErrorBag.php');

//Middleware
require base_path('config/Middleware.php');
require base_path('core/MiddlewareManager.php');

require base_path('app/middleware/AuthMiddleware.php');
require base_path('app/middleware/GuestMiddleware.php');