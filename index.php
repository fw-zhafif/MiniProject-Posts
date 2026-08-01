<?php

require "functions.php";
require "Database.php";
require "Router.php";

session_start();

$router = Router::load('routes.php');
$router->route();
