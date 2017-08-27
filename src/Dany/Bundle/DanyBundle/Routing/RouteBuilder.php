<?php

namespace Dany\Bundle\DanyBundle\Routing;

use Dany\Bundle\DanyBundle\Configuration\DanyRoute;
use Dany\Bundle\DanyBundle\Configuration\ResourceConfigurationInterface;
use Symfony\Component\Routing\Route;

class RouteBuilder
{
    public function createRoutes(ResourceConfigurationInterface $configuration) : array
    {
        $routingConfig = $configuration->getRoutingConfiguration();

        $routes = [];
        foreach ($routingConfig as $danyRoute) {
            $route = $this->createRoute(
                $danyRoute->getPath(),
                $this->determineController($configuration)
            );

            $this->addRouteOptions($route, $danyRoute);

            $routeName = $danyRoute->normalize($configuration->getName());

            $routes[$routeName] = $route;
        }

        return $routes;
    }

    private function addRouteOptions(Route $route, DanyRoute $danyRoute)
    {
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
    }

    private function createRoute(string $path, array $controller) : Route
    {
        return new Route($path, $controller);
    }

    private function determineController(ResourceConfigurationInterface $configuration)
    {
        $controller = null;
        if (!$configuration->hasFlowConfiguration()) {
            $controller = ['_controller' => 'DanyBundle:NoFlow:noFlow'];
        } else {
            $controller = ['_controller' => 'DanyBundle:FlowMachine:flowMachine'];
        }

        if (is_null($controller)) {
            throw new \RuntimeException(
                sprintf(
                    'Dany could not determine the controller for this request. Please, check your configuration for \'%s\'',
                    $configuration->getName()
                )
            );
        }

        return $controller;
    }
}