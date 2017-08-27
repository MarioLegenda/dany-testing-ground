<?php

namespace Dany\Bundle\DanyBundle\Configuration;

use Dany\Library\AbstractLooseCollection;
use Symfony\Component\Routing\Route;

class RoutingConfiguration extends AbstractLooseCollection implements RoutingConfigurationInterface
{
    /**
     * RoutingConfiguration constructor.
     * @param array $routing
     */
    public function __construct(array $routing)
    {
        $this->validateRouting($routing);
        $this->addRoutes($routing);
    }

    /**
     * @param string $routeName
     * @return DanyRoute
     */
    public function getRoute(string $routeName): DanyRoute
    {
        return $this->get($routeName);
    }
    /**
     * @param string $routeName
     * @return bool
     */
    public function hasRoute(string $routeName) : bool
    {
        return $this->has($routeName);
    }
    /**
     * @return array
     */
    public function getRoutes(): array
    {
        return $this->all();
    }

    private function addRoutes(array $routing)
    {
        foreach ($routing as $routeName => $route) {
            $this->add($routeName, new DanyRoute($routeName, $route));
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

            $routeName = $danyRoute->normalize($danyAppName);

            $routes[$routeName] = $route;
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