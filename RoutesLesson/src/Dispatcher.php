<?php

namespace Src;

use phpDocumentor\Parser\Exception;
use ReflectionException;

class Dispatcher
{
    /**
     * @param $callback
     * @param array $params
     * @param string $namespace
     * @return mixed
     * @throws ReflectionException
     * @throws \Exception
     */
    public function dispatch($callback, $params = [], $namespace = "App\\")
    {
        if (is_callable($callback)) {
            return call_user_func_array($callback, array_values($params));

        } elseif (is_string($callback)) {

            if (!!strpos($callback, '@') !== false) {
                $callback = explode('@', $callback);
                $controller = $namespace.$callback[0];
                $method = $callback[1];

                $reflectionClass = new \ReflectionClass($controller);

                if (
                    $reflectionClass->isInstantiable()
                    &&
                    $reflectionClass->hasMethod($method)
                ) {
                    return call_user_func_array([new $controller, $method], array_values($params));
                } else {
                    throw new \Exception("Controller couldn't be instantiated or method called doesn't exists");
                }
            }
        }
        throw new \Exception("Method not found");
    }
}