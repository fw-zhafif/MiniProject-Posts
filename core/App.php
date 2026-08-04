<?php

class App
{
    protected static array $container = [];

    public static function bind($key, $value)
    {
        static::$container[$key] = $value;
    }

    public static function resolve($key)
    {
        if (! array_key_exists($key, static::$container)) {
            throw new Exception("No matching binding found for {$key}");
        }

        return static::$container[$key];
    }
}