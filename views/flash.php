<?php

class Flash
{
    public static function set($key, $value)
    {
        $_SESSION['_flash'][$key] = $value;
    }

    public static function get($key)
    {
        if (! isset($_SESSION['_flash'][$key])) 
        {
            return null;
        }

        $value = $_SESSION['_flash'][$key];

        unset($_SESSION['_flash'][$key]);

        return $value;
    }
}