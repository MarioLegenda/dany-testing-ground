<?php

namespace Dany\Bundle\DanyBundle\Configuration;

interface RoutingConfigurationInterface
{
    public function getRoutes() : array;
    public function getRoute(string $routeName) : DanyRoute;
}