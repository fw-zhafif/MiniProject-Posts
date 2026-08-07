<?php

namespace Core;
use Exception;

class MiddlewareManager {
    public static function run($middleware)
    {
        $map = self::resolveMiddlewareMap();

        if (! array_key_exists($middleware, $map)) {
            throw new Exception("Middleware [$middleware] not found.");
        }

        $class = $map[$middleware];
        $middleware = new $class();
        $middleware->handle();
    }

    private static function resolveMiddlewareMap()
    {
        return require base_path('config/middleware.php');
    }
}