<?php

class ValidationException extends Exception
{
    public ErrorBag $errors;
    protected array $old;

    public function __construct(ErrorBag $errors, array $old = [])
    {
        parent::__construct();

        $this->errors = $errors;
        $this->old = $old;
    }

    public function respond()
    {
        Flash::set('errors', $this->errors);

        Flash::set('old', $this->old);

        back();
    }
}