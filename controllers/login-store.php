<?php

$email = trim($_POST['email']);
$password = trim($_POST['password']);

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