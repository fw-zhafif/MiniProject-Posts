<?php

$email = trim(Request::input('email'));
$password = trim(Request::input('password'));

$errors = new ErrorBag();

if (! Validator::required($email)) {

    $errors->add(
        'email',
        'Email wajib diisi.'
    );

}

if (! Validator::required($password)) {

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

    redirect('/login');
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

    redirect('/login');
}

$_SESSION['user'] = [

    'email' => $email

];

redirect('/');
