<?php

class ErrorBag
{
    protected $errors = [];

    public function add($key, $message)
    {
        $this->errors[$key] = $message;
    }

    public function has($key)
    {
        return isset($this->errors[$key]);
    }

    public function first($key)
    {
        return $this->errors[$key] ?? null;
    }

    public function all()
    {
        return $this->errors;
    }

    public function isEmpty()
    {
        return empty($this->errors);
    }
}