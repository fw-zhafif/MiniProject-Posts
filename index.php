<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

    require "functions.php";
    require "Database.php";
    require "Router.php";


    $router = Router::load('routes.php');
    $router->route();
