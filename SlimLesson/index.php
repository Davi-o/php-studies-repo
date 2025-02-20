<?php

use Slim\Slim;

require_once "vendor/autoload.php";

$app = new Slim();

$app->get('/hello/:name', function ($name) {
    echo "Hello, " . $name;
});

$app->run();
