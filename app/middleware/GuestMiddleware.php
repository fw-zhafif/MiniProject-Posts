<?php

namespace App\Middleware;

class GuestMiddleware
{
    public function handle()
    {
        if ( isset($_SESSION['user'])) 
        {
            redirect('/');
        }
    }
}