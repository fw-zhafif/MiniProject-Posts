<?php

namespace Core;

class Config
{
    protected static array $items = [];

    public static function load() 
    {
        $files = glob(base_path('config/*.php'));

        foreach ($files as $file) {
            $name = pathinfo($file, PATHINFO_FILENAME);

            $config = require $file;

            static::$items[$name]= $config;
        }
    }

    public static function get($key) 
    {
        return static::$items[$key] ?? null;
    }
}