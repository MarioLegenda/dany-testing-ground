<?php

namespace Dany\Bundle\DanyBundle\Routing;

use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\Config\Loader\LoaderResolverInterface;
use Symfony\Component\Routing\RouteCollection;

class ResourceLoader implements LoaderInterface
{
    /**
     * @var bool $loaded
     */
    private $loaded = false;
    /**
     * @inheritdoc
     */
    public function load($resource, $type = null)
    {
        if (true === $this->loaded) {
            throw new \RuntimeException('Dany route loader has already been loaded');
        }

        $routes = new RouteCollection();

        $path = '/';

        return $routes;
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