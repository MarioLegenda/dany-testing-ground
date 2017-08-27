<?php

namespace Dany\Bundle\DanyBundle\Configuration;

use Dany\Library\AbstractLooseCollection;

class RoutingConfiguration extends AbstractLooseCollection implements RoutingConfigurationInterface
{
    /**
     * @var array[Route] $routes
     */
    private $routes;
    /**
     * RoutingConfiguration constructor.
     * @param array $routing
     */
    public function __construct(array $routing)
    {
        $this->validateRouting($routing);

        $this->routes = $this->createRoutes($routing);
    }

    /**
     * @param string $routeName
     * @return Route
     */
    public function getRoute(string $routeName): Route
    {
        return $this->routes[$routeName];
    }
    /**
     * @param string $routeName
     * @return bool
     */
    public function hasRoute(string $routeName) : bool
    {
        return array_key_exists($routeName, $this->routes);
    }
    /**
     * @return array
     */
    public function getRoutes(): array
    {
        return $this->routes;
    }

    private function createRoutes(array $routing) : array
    {
        $routes = [];

        foreach ($routing as $routeName => $route) {
            $routes[$routeName] = new Route($routeName, $route);
        }

        return $routes;
    }

    private function validateRouting(array $routing)
    {
        if (empty($routing)) {
            throw new \RuntimeException(
                sprintf(
                    'Invalid dany configuration. Empty \'routing\' config'
                )
            );
        }

        foreach ($routing as $routeName => $routeConfig) {
            if (!array_key_exists('path', $routeConfig)) {
                throw new \RuntimeException(
                    sprintf(
                        'Invalid dany configuration. Empty \'path\' config under \'%s\'',
                        $routeName
                    )
                );
            }
        }
    }
}