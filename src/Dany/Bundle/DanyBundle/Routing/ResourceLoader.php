<?php

namespace Dany\Bundle\DanyBundle\Routing;

use Dany\Bundle\DanyBundle\Configuration\ResourceConfigurationInterface;
use Dany\Bundle\DanyBundle\Configuration\RoutingConfiguration;
use Dany\Library\CollectionInterface;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\Config\Loader\LoaderResolverInterface;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Config\Definition\Processor;
use Symfony\Component\Yaml\Yaml;

class ResourceLoader implements LoaderInterface
{
    /**
     * @var CollectionInterface $configuration
     */
    private $configuration;

    /**
     * @var bool $loaded
     */
    private $loaded = false;

    /**
     * ResourceLoader constructor.
     * @param CollectionInterface $configuration
     */
    public function __construct(CollectionInterface $configuration)
    {
        $this->configuration = $configuration;
    }

    /**
     * @inheritdoc
     */
    public function load($resource, $type = null)
    {
        if (true === $this->loaded) {
            throw new \RuntimeException('Dany route loader has already been loaded');
        }

        $routeCollection = new RouteCollection();

        foreach ($this->configuration as $danyAppName => $config) {
            $routingConfig = $config->getRoutingConfiguration();

            $routes = RoutingConfiguration::createFromDanyRoute(
                $danyAppName,
                $routingConfig->getRoutes()
            );

            foreach ($routes as $routeName => $route) {
                $routeCollection->add($routeName, $route);
            }
        }

        return $routeCollection;
    }

    /**
     * @inheritdoc
     */
    public function setResolver(LoaderResolverInterface $resolver)
    {
        // intentionally left blank
    }
        /**
     * @inheritdoc
     */
    public function getResolver()
    {
        // intentionally left blank
    }

    /**
     * @inheritdoc
     */
    public function supports($resource, $type = null)
    {
        return 'dany' === $type;
    }
}