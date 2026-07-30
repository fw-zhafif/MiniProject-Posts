<?php

class Router {
    protected $routes = [];
    
    public function add($method, $uri, $controller) 
    {
    $this->routes[] = [
        'uri' => $uri,
        'controller' => $controller,
        'method' => $method
    ];

    return $this;
    }
    public function get($uri, $controller) 
    {
        return $this->add('GET',$uri,$controller);
    }

     public function post($uri, $controller) 
    {
        return $this->add('POST',$uri,$controller);
    }

    public function delete($uri, $controller) 
    {
        return $this->add('DELETE',$uri,$controller);
    }

    public function patch($uri, $controller) 
    {
        return $this->add('PATCH',$uri,$controller);
    }

    public function put($uri, $controller) 
    {
        return $this->add('PUT',$uri,$controller);
    }

    public function route() {

    }
}


    // $routes = require "routes.php";
    // $uri = parse_url($_SERVER['REQUEST_URI'])['path'];
    // $method = $_SERVER['REQUEST_METHOD'];

    // if(! isset($routes[$method]))  {
    //     abort();
    // }

    // if(array_key_exists($uri, $routes[$method])) {
    //     require $routes[$method][$uri];
    // } else {
    //     abort();
    // };
    
