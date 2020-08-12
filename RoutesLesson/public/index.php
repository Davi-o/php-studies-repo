<?php

require __DIR__.'/../app.php';

$request = new Src\Request();
$router = new Src\Router();

try {
    $router->resolve($request);
} catch (ReflectionException $e) {
    echo $e;
} catch (Exception $e) {
    echo $e;
}