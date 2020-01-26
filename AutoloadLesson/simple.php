<?php

//function __autoload($class){
//    require_once "{$class}.php";
//}

//function requireClass($class)
//{
//    $file = "{$class}.php";
//
//    if(file_exists($file)){
//        require_once ($file);
//    }
//}

spl_autoload_register(function($class)
    {
        $file = "{$class}.php";

        if(file_exists($file)){
            require_once ($file);
        }
    }
);

$car = new Car();
echo($car->speedUp(100));
