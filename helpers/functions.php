<?php

    function base_path($path = '')
    {
        return BASE_PATH . DIRECTORY_SEPARATOR . ltrim($path, '/\\');
    }

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

    function redirect($path) {
        header("Location:{$path}");
        die();
    }

    function old($key) 
    {
        global $old;

        return old($key) ?? '';
    }

    function error($key)
    {
        global $errors;

        if (! $errors) {
            return null;
        }

        return $errors->first($key);
    }

?>