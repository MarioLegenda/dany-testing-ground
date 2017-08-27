<?php

namespace Dany\Bundle\DanyBundle\Configuration;

interface RoutingConfigurationInterface
{
    /**
     * @return array
     */
    public function getRoutes() : array;

    /**
     * @param string $routeName
     * @return DanyRoute
     */
    public function getRoute(string $routeName) : DanyRoute;

    /**
     * @param string $routeName
     * @return bool
     */
    public function hasRoute(string $routeName) : bool;
}