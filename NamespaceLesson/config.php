<?php

spl_autoload_register(function ($className)
    {
        $directory = "class";
        $filename = str_replace ("\\", "/", $directory . DIRECTORY_SEPARATOR . $className . ".php");


        if (file_exists($filename)) {
            require_once ($filename);
        }
    }
);