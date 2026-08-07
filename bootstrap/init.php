<?php

use Core\App;
use Core\Config;
use App\Providers\AppServiceProvider;

Config::load();

App::register(AppServiceProvider::class);
