<?php

namespace Dany\Bundle\DanyBundle\Configuration;

class Route
{
    /**
     * @var string $path
     */
    private $path = null;
    /**
     * @var array|null $requirements
     */
    private $requirements = null;
    /**
     * @var string|null $host
     */
    private $host = null;
    /**
     * @var null|string $methods
     */
    private $methods = null;
    /**
     * Route constructor.
     * @param array $routing
     */
    public function __construct(array $routing)
    {
        $this->parse($routing);
    }

    /**
     * @return mixed
     */
    public function getPath()
    {
        return $this->path;
    }
    /**
     * @param mixed $path
     */
    public function setPath($path)
    {
        $this->path = $path;
    }
    /**
     * @return mixed
     */
    public function getRequirements()
    {
        return $this->requirements;
    }
    /**
     * @param mixed $requirements
     */
    public function setRequirements($requirements)
    {
        $this->requirements = $requirements;
    }
    /**
     * @return mixed
     */
    public function getHost()
    {
        return $this->host;
    }
    /**
     * @param mixed $host
     */
    public function setHost($host)
    {
        $this->host = $host;
    }
    /**
     * @return mixed
     */
    public function getMethods()
    {
        return $this->methods;
    }
    /**
     * @param mixed $methods
     */
    public function setMethods($methods)
    {
        $this->methods = $methods;
    }

    private function parse(array $route)
    {
        $this->path = $route['path'];

        if (array_key_exists('requirements', $route)) {
            $this->requirements = $route['requirements'];
        }

        if (array_key_exists('host', $route)) {
            $this->host = $route['host'];
        }

        if (array_key_exists('methods', $route)) {
            $this->methods = $route['methods'];
        }
    }
}