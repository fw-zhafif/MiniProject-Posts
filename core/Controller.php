<?php

abstract class Controller
{
    protected function view($path, $attributes = [])
    {
        view($path, $attributes);
    }

    protected function redirect($path)
    {
        redirect($path);
    }

    protected function resolve($class)
    {
        return App::resolve($class);
    }
}