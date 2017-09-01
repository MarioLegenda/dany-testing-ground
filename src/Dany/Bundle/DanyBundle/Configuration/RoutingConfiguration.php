<?php

namespace Dany\Bundle\DanyBundle\Configuration;

use Dany\Library\BaseLooseCollection;

class RoutingConfiguration extends BaseLooseCollection implements RoutingConfigurationInterface
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
     * @inheritdoc
     */
    public function getRoute(string $routeName): DanyRoute
    {
        return $this->get($routeName);
    }
    /**
     * @inheritdoc
     */
    public function hasRoute(string $routeName) : bool
    {
        return $this->has($routeName);
    }
    /**
     * @inheritdoc
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