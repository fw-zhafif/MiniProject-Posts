<?php

namespace App\Providers;

use Core\App;
use Core\Database;
use Core\Config;

class AppServiceProvider
{
    public function register()
    {
        $config = config('database');

        App::singleton(
            Database::class,
            function () use ($config) 
                {
                    return new Database($config);
                }
        );
    }
}