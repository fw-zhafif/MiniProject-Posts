<?php

$email = $_POST['email'];
$password = $_POST['password'];

if (
    $email === 'admin@example.com'
    &&
    $password === '123'
) {
    $_SESSION['user'] = [
        'email' => $email
    ];

    redirect('/');
}

redirect('/login');