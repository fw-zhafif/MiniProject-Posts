<?php
    $config = require "config.php";
    $db = new Database($config['db']);

    $posts = $db->query("SELECT * FROM posts");
    
    require "views/index.view.php";
?>