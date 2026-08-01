<?php

class Router {
    protected $routes = [];
    protected $currentRoute;
    
    public function add($method, $uri, $controller) 
    {
    $this->routes[] = [
        'uri' => $uri,
        'controller' => $controller,
        'method' => $method,
        'middleware' => null
    ];
    $this->currentRoute = array_key_last($this->routes);    
    return $this;
    }

    public function only($middleware) {
        $this->routes[$this->currentRoute]['middleware'] = $middleware;
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

    public function route() 
    {
        $uri = $this->resolveUri();
        $method = $this->resolveMethod();

        $route = $this->findRoute($uri,$method);

        if (! $route) {
        abort();
        }

        $this->runMiddleware($route['middleware']);
        $this->loadController($route['controller']);
    }

    private function resolveUri() {
        $uri = parse_url($_SERVER['REQUEST_URI'])['path'];
        return $uri;
    }

    private function resolveMethod() {
        $method = strtoupper($_SERVER['REQUEST_METHOD']);

        if ($method === 'POST' && isset($_POST['_method'])) 
        {
        $method = strtoupper($_POST['_method']);
        }

        return $method;
    }

    private function findRoute($uri,$method) {
        foreach ( $this->routes as $route) 
        {
            if ( $route['uri'] === $uri && $route['method'] === $method ) {
                return $route;  
            }
        }
        return null;
    }

    private function runMiddleware($middleware)
    {
        if (! $middleware) 
        {
            return;
        }
        
        MiddlewareManager::resolve($middleware);
    }

    private function loadController($controller) {
        require $controller;
    }

    public static function load($file)
    {
        $router = new static();

        require $file;

        return $router;
    }

}

    // if(! isset($routes[$method]))  {
    //     abort();
    // }

    // if(array_key_exists($uri, $routes[$method])) {
    //     require $routes[$method][$uri];
    // } else {
    //     abort();
    // };
    
