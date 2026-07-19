<?php
    function dd($value) {
        echo "<pre>";
        var_dump($value);
        echo "</pre>";

    die();
    }

    function abort($code = 404) {
        http_response_code($code);
        echo "file ini tidak bisa dijangkau";
        die();
    }

?>