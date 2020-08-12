<?php
$router = new Src\Router();

try {
    $router->get('/', function () {
        print_r('testando');
    });
} catch (Exception $e) {
    var_dump($e);
}