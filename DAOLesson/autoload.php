<?php

spl_autoload_register(function ($className)
{
    $directories = [
        "model",
        "tests",
        "controller",
        "database_dao"
    ];

    foreach ($directories as $directory) {
        $filename = str_replace ("\\", "/", $directory . DIRECTORY_SEPARATOR . $className . ".php");

        if (file_exists($filename)) {
            require ("../".$filename);
        }
    }
}
);
