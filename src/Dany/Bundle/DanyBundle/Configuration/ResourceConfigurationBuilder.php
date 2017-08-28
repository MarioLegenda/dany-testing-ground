<?php

namespace Dany\Bundle\DanyBundle\Configuration;

use Dany\Library\CollectionInterface;

class ResourceConfigurationBuilder
{
    /**
     * @var array $config
     */
    private $config;
    /**
     * ResourceConfigurationBuilder constructor.
     * @param array $config
     */
    public function __construct(array $config)
    {
        $this->config = $config;
    }

    /**
     * @return CollectionInterface
     */
    public function buildConfiguration() : CollectionInterface
    {
        $collection = new ResourceConfigurationCollection();

        foreach ($this->config as $resourceName => $resource) {
            $modelConfiguration = null;
            $listenerConfiguration = null;
            $flowConfiguration = null;
            $routingConfiguration = new RoutingConfiguration($resource['routing']);

            // multiple models configuration here

            if (array_key_exists('model', $resource)) {
                $modelConfiguration = new ModelConfiguration($resource['model']);
            }

            if (!empty($resource['listeners'])) {
                $listenerConfiguration = new ListenerConfiguration($resource['listeners']);
            }

            if (!empty($resource['flow'])) {
                $flowConfiguration = new FlowConfiguration($resource['flow']);
            }

            if (!$modelConfiguration instanceof ModelConfigurationInterface) {
                throw new \RuntimeException(
                    'Model configuration not set at runtime'
                );
            }

            $collection->add(
                $resourceName,
                new ResourceConfiguration(
                    $resourceName,
                    $modelConfiguration,
                    $routingConfiguration,
                    $listenerConfiguration,
                    $flowConfiguration
                )
            );
        }

        return $collection;
    }
}