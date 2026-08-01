<?php

class MiddlewareManager {
    public static function resolve($middleware)
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
        return require 'MiddlewareMap.php';
    }
}