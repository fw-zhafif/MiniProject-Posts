<?php

class Validator
{
    public static function string($value)
    {
        if (! is_string($value)) {
            return false;
        }
    }

    public static function required($value)
    {
        return trim($value) !== '';
    }

    public static function min($value, $length)
    {
        return mb_strlen(trim($value)) >= $length;
    }

    public static function max($value, $length)
    {
        return mb_strlen(trim($value)) <= $length;
    }
    
}