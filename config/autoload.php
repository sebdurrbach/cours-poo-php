<?php

spl_autoload_register(function ($className) {
    $className = str_replace("\\", "/", $className);
    $className = str_replace("App/", "src/", $className);
    $path = $className . ".php";

    if (file_exists($path)) {
        require_once $path;
    }
});
