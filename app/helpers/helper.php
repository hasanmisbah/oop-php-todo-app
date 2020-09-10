<?php

    function view($name, $data = [])
    {
        extract($data);
        return require_once SITE_ROOT. "/views/{$name}.views.php";
    }

    function redirect($path)
    {
        header("Location: /{$path}");
    }



