<?php

    $routes = require "routes.php";
    $uri = parse_url($_SERVER['REQUEST_URI'])['path'];
    $method = $_SERVER['REQUEST_METHOD'];

    if(! isset($routes[$method]))  {
        abort();
    }

    if(array_key_exists($uri, $routes[$method])) {
        require $routes[$method][$uri];
    } else {
        abort();
    };
    
