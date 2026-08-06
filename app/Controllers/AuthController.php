<?php

namespace App\Controllers;

use Core\Controller;
use Core\Request;
use Core\ErrorBag;
use Core\Rules;
use Flash;  

class AuthController extends Controller 
{
    public function create()
    {
        $this->view('auth.login', [
            'title' => 'Login'
        ]);
    }

    public function store()
    {
        $email = trim(Request::input('email'));
        $password = trim(Request::input('password'));

        $errors = new ErrorBag();

        if (! Rules::required($email)) {

            $errors->add(
                'email',
                'Email wajib diisi.'
            );

        }

        if (! Rules::required($password)) {

            $errors->add(
                'password',
                'Password wajib diisi.'
            );

        }

        if (! $errors->isEmpty()) {

            Flash::set(
                'errors',
                $errors
            );

            Flash::set(
                'old',
                [
                    'email' => $email
                ]
            );

            return redirect('/login');
        }

        if (
            $email !== 'admin@example.com'
            ||
            $password !== '123'
        ) {

            $errors->add(
                'auth',
                'Email atau password salah.'
            );

            Flash::set(
                'errors',
                $errors
            );

            Flash::set(
                'old',
                [
                    'email' => $email
                ]
            );

            return redirect('/login');
        }

        $_SESSION['user'] = [

            'email' => $email

        ];

        redirect('/');
    }

    public function logout()
    {     
        unset($_SESSION['user']);

        redirect('/');
    }
}