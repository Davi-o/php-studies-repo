<?php

namespace Src;

use phpDocumentor\Parser\Exception;
use phpDocumentor\Reflection\Types\Object_;
use ReflectionException;
use Src\Dispatcher;
use Src\RouterCollection;

/**
 * Class Router
 * @package Src
 */
class Router
{
    /** @var  \Src\RouterCollection */
    protected $routerCollection;

    /** @var \Src\Dispatcher */
    protected $dispatcher;

    /**
     * Router constructor.
     */
    public function __construct()
    {
        $this->routerCollection = new RouterCollection();
        $this->dispatcher = new Dispatcher();
    }

    /**
     * @param $request
     * @return mixed|void
     * @throws ReflectionException
     * @throws \Exception
     */
    public function resolve($request)
    {
        $route = $this->find($request->method(), $request->uri());

        if ($route) {
            return $this->dispatch($route);
        }

        return $this->notFound();
    }

    /**
     * @param $pattern
     * @param $callback
     * @return Router
     * @throws \Exception
     */
    public function get($pattern, $callback)
    {
        $this->routerCollection->add('get', $pattern, $callback);
        return $this;
    }

    /**
     * @param $pattern
     * @param $callback
     * @return $this
     * @throws \Exception
     */
    public function post($pattern, $callback)
    {
        $this->routerCollection->add('post', $pattern, $callback);
        return $this;
    }

    /**
     * @param $pattern
     * @param $callback
     * @return $this
     * @throws \Exception
     */
    public function put($pattern, $callback)
    {
        $this->routerCollection->add('put', $pattern, $callback);
        return $this;
    }

    /**
     * @param $pattern
     * @param $callback
     * @return $this
     * @throws \Exception
     */
    public function delete($pattern, $callback)
    {
        $this->routerCollection->add('delete', $pattern, $callback);
        return $this;
    }

    /**
     * @param $requestType
     * @param $pattern
     * @return false|object
     * @throws \Exception
     */
    public function find($requestType, $pattern)
    {
        return $this->routerCollection->where($requestType, $pattern);
    }

    /**
     * @param $route
     * @param string $namespace
     * @return mixed
     * @throws ReflectionException
     */
    protected function dispatch($route, $namespace = "App\\")
    {
        return $this->dispatcher->dispatch($route->callback, $route->uri, $namespace);
    }

    protected function notFound()
    {
        return header("HTTP/1.0 404 NOT FOUND", true, 404);
    }
}