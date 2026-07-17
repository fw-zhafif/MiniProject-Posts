<?php
    $config = require "config.php";
    $db = new Database($config['db']);
    
    require "views/index.view.php";
?>