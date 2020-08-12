<?php
namespace Src;

use phpDocumentor\Parser\Exception;
use phpDocumentor\Reflection\Types\Callable_;

/**
 * Class RouteCollection
 * @package Src
 */
class RouterCollection
{
    /** @var array */
    protected $postRoutes = [];

    /** @var array */
    protected $getRoutes = [];

    /** @var array */
    protected $putRoutes = [];

    /** @var array */
    protected $deleteRoutes = [];

    /** @var string[]  */
    const REQUESTS = [
        'post',
        'get',
        'put',
        'delete'
    ];

    /**
     * @param string $requestType
     * @param $pattern
     * @param callable $callback
     * @return mixed
     * @throws \Exception
     */
    public function add($requestType, $pattern, $callback)
    {
        if (in_array($requestType, self::REQUESTS)) {
            return $this->{'add'.ucfirst($requestType)}($pattern, $callback);
        }

        throw new \Exception("{$requestType} is not a valid method");
    }

    /**
     * @param $pattern
     * @return string
     */
    protected function definePattern($pattern)
    {
        $pattern = strlen($pattern) > 1 ? implode('/', array_filter(explode('/', $pattern))) : $pattern;
        return '/^' . str_replace('/', '\/', $pattern) . '$/';

    }

    /**
     * @param $requestType
     * @param $pattern
     * @return false|object
     * @throws \Exception
     */
    public function where($requestType, $pattern)
    {
        if (in_array($requestType, self::REQUESTS)) {
            return $this->{'find'.ucfirst($requestType)}($pattern);
        }

        throw new \Exception("{$requestType} is not a valid request type");
    }

    /**
     * @param $uri
     * @return string
     */
    public function parseUri($uri)
    {
        return strlen($uri) > 1 ? implode('/', array_filter(explode('/', $uri))) : $uri ;
    }

    /**
     * @param $pattern
     * @return false|object
     */
    protected function findPost($pattern)
    {
        foreach ($this->postRoutes as $request => $callback) {
            if (preg_match($request, $pattern, $pieces)) {
                return (object) ['callback' => $callback, 'uri' => $pieces];
            }
        }
        return false;
    }

    /**
     * @param $pattern
     * @return false|object
     */
    protected function findGet($pattern)
    {
        $pattern = $this->parseUri($pattern);
        foreach ($this->getRoutes as $request => $callback) {
            if (preg_match($request, $pattern, $pieces)) {
                return (object) ['callback' => $callback, 'uri' => $pieces];
            }
        }
        return false;
    }

    /**
     * @param $pattern
     * @return false|object
     */
    protected function findPut($pattern)
    {
        $pattern = $this->parseUri($pattern);
        foreach ($this->putRoutes as $request => $callback) {
            if (preg_match($request, $pattern, $pieces)) {
                return (object) ['callback' => $callback, 'uri' => $pieces];
            }
        }
        return false;
    }

    /**
     * @param $pattern
     * @return false|object
     */
    protected function findDelete($pattern)
    {
        $pattern = $this->parseUri($pattern);
        foreach ($this->deleteRoutes as $request => $callback) {
            if (preg_match($request, $pattern, $pieces)) {
                return (object) ['callback' => $callback, 'uri' => $pieces];
            }
        }
        return false;
    }

    /**
     * @param $pattern
     * @param $callback
     * @return RouterCollection
     */
    protected function addPost($pattern, $callback)
    {
        $this->postRoutes[$this->definePattern($pattern)] = $callback;
        return $this;
    }

    /**
     * @param $pattern
     * @param $callback
     * @return RouterCollection
     */
    protected function addGet($pattern, $callback)
    {
        $this->getRoutes[$this->definePattern($pattern)] = $callback;
        return $this;
    }

    /**
     * @param $pattern
     * @param $callback
     * @return RouterCollection
     */
    protected function addPut($pattern, $callback)
    {
        $this->putRoutes[$this->definePattern($pattern)] = $callback;
        return $this;
    }

    /**
     * @param $pattern
     * @param $callback
     * @return RouterCollection
     */
    protected function addDelete($pattern, $callback)
    {
        $this->deleteRoutes[$this->definePattern($pattern)] = $callback;
        return $this;
    }
}