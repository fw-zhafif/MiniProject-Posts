<?php

namespace Core;


abstract class Validator
{
    protected ErrorBag $errors;

    protected array $attributes;

    public function __construct(array $attributes)
    {
        $this->attributes = $attributes;
        $this->errors = new ErrorBag();
    }
    
    public static function validate(array $attributes)
    {
        $validator = new static($attributes);

        $validator->rules();

        $validator->fail();

        return $attributes;
    }

    abstract protected function rules();

    protected function fail()
    {
        if (! $this->errors->isEmpty()) {
            throw new ValidationException(
                $this->errors,
                $this->attributes
            );
        }
    }
}