<?php
use Core\Router;

define('BASE_PATH', dirname(__DIR__));

require BASE_PATH . '/helpers/functions.php';
require base_path('bootstrap/autoload.php');
require base_path('bootstrap/init.php');

session_start();

Router::load(base_path('routes/web.php'))
    ->route();