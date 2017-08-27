<?php

namespace Dany\Bundle\DanyBundle\Configuration;

use Dany\Library\AbstractLooseCollection;
use Symfony\Component\Routing\Route;

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
     * @return DanyRoute
     */
    public function getRoute(string $routeName): DanyRoute
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
            $routes[$routeName] = new DanyRoute($routeName, $route);
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

    /**
     * @param string $danyAppName
     * @param array $danyRoutes
     * @return array
     */
    public static function createFromDanyRoute(string $danyAppName, array $danyRoutes) : array
    {
        $routes = [];
        foreach ($danyRoutes as $danyRoute) {
            $route = new Route($danyRoute->getPath());

            if ($danyRoute->hasMethods()) {
                $route->setMethods($danyRoute->getMethods());
            }

            if ($danyRoute->hasRequirements()) {
                $route->setRequirements($danyRoute->getRequirements());
            }

            if ($danyRoute->hasHost()) {
                $route->setHost($danyRoute->getHost());
            }

            if ($danyRoute->hasCondition()) {
                $route->setCondition($danyRoute->getCondition());
            }

            $danyAppName = preg_replace('#[\\-\\.]#', '_', $danyAppName);
            $danyRouteName = preg_replace('#[\\-\\.]#', '_', $danyRoute->getName());

            $routeName = sprintf('%s_%s', $danyAppName, $danyRouteName);

            $routes[$routeName] = $route;
        }

        return $routes;
    }
}