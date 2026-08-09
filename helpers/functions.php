<?php

    function base_path($path = '')
    {
        return BASE_PATH . DIRECTORY_SEPARATOR . ltrim($path, '/\\');
    }

    function dd(...$values) {
        echo '<pre>';

        foreach ($values as $value) {
            var_dump($value);
        }

        echo '</pre>';
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

        return $old[$key] ?? '';
    }

    function error($key)
    {
        global $errors;

        if (! $errors) {
            return null;
        }

        return $errors->first($key);
    }

    function view($path, $attributes = [])
    {
        extract($attributes);

        $content = base_path(
            'views/' . str_replace('.', '/', $path) . '.php'
        );

        require base_path('views/layouts/app.php');
    }
    
    function back()
    {
        redirect($_SERVER['HTTP_REFERER'] ?? '/');
    }

    function config($key)
    {
        return Core\Config::get($key);
    }

?>