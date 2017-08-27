<?php

namespace Dany\Bundle\DanyBundle\Configuration;

class DanyRoute
{
    /**
     * @var string $name
     */
    private $name;
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
     * @var null|string $condition
     */
    private $condition = null;

    /**
     * Route constructor.
     * @param string $routeName
     * @param array $routing
     */
    public function __construct(string $routeName, array $routing)
    {
        $this->name = $routeName;

        $this->parse($routing);
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
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
     * @return bool
     */
    public function hasPath() : bool
    {
        return is_string($this->path);
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
     * @return bool
     */
    public function hasRequirements() : bool
    {
        return is_array($this->requirements) and !empty($this->requirements);
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
     * @return bool
     */
    public function hasHost() : bool
    {
        return is_string($this->host);
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

    /**
     * @return null|string
     */
    public function getCondition()
    {
        return $this->condition;
    }

    /**
     * @param null|string $condition
     */
    public function setCondition($condition)
    {
        $this->condition = $condition;
    }

    /**
     * @return bool
     */
    public function hasCondition() : bool
    {
        return is_string($this->condition);
    }

    /**
     * @return bool
     */
    public function hasMethods() : bool
    {
        return is_array($this->methods) and !empty($this->methods);
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

        if (array_key_exists('condition', $route)) {
            $this->condition = $route['condition'];
        }
    }
}