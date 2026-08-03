<?php

$config = require base_path("config.php");
$db = new Database($config['db']);

require base_path("views/index.view.php");
