<?php

namespace App\Validation;
use Core\Validator;
use Core\Rules;
use Core\ValidationException;
use Core\ErrorBag;

class PostValidator extends Validator
{
    protected function rules()
    {
        $title = $this->attributes['title'];
        $body = $this->attributes['body'];

        if (! Rules::required($title)) {

            $this->errors->add('title', 'Title is required.');

        } elseif (! Rules::min($title, 5)) {

            $this->errors->add('title', 'Minimal 5 karakter.');

        } elseif (! Rules::max($title, 255)) {

            $this->errors->add('title', 'Maksimal 255 karakter.');

        }

        if (! Rules::required($body)) {

            $this->errors->add('body', 'Body is required.');

        } elseif (! Rules::min($body, 20)) {

            $this->errors->add('body', 'Minimal 20 karakter.');

        }
    }
}