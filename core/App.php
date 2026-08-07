<?php

namespace Core;
use ReflectionClass;
use Exception;

class App
{
    protected static array $container = [];
    protected static array $instances = [];

    public static function bind($key, $value)
    {
        static::$container[$key] = $value;
    }

    public static function resolve($key)
    {
        if (array_key_exists($key, static::$container)) {
             $concrete = static::$container[$key];

             return $concrete();
        }

      return static::build($key);
    }
    
    public static function build($class) 
    {
        $reflection = new ReflectionClass($class);

        $constructor = $reflection->getConstructor();

        if (is_null($constructor)) {
            return $reflection->newInstance();
        }

        $parameters = $constructor->getParameters();

        $dependencies = [];

        foreach ($parameters as $parameter) 
        {
            $type = $parameter->getType();

            if ($type->isBuiltin()) 
            {
                throw new Exception(
                    "Cannot resolve builtin type."
                );
            }

            $dependencies[] = static::resolve(
                $type->getName()
            );
        }

        return $reflection->newInstanceArgs(
            $dependencies
         );
    }

    public static function singleton($key, $closure)
    {
        static::$container[$key] = function () use ($key, $closure) 
        {

            if (! isset(static::$instances[$key])) {

                static::$instances[$key] = $closure();

            }

            return static::$instances[$key];
        };
    }

    public static function register($provider)
    {
        $provider = new $provider();

        $provider->register();
    }
}