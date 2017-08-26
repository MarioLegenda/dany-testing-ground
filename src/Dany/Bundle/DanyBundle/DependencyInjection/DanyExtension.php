<?php

namespace Dany\Bundle\DanyBundle\DependencyInjection;

use Dany\Bundle\DanyBundle\Configuration\ResourceConfigurationBuilder;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration.
 *
 * @link http://symfony.com/doc/current/cookbook/bundles/extension.html
 */
class DanyExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $this->validateResources($config['resources'], $container);

        $loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));

        $loader->load('services.xml');

        $this->addConfigurationToContainer($container, $config['resources']);
    }

    private function validateResources($resources, ContainerInterface $container)
    {
        foreach ($resources as $resourceName => $resource) {
            if (empty($resource['model']) and empty($resource['models'])) {
                throw new \RuntimeException(
                    sprintf(
                        'Invalid dany resource configuration. A dany resource should have one of \'model\' or \'models\' options'
                    )
                );
            }

            $this->validateListeners($resource, $container);
            $this->validateFlow($resource, $container);
        }
    }

    private function validateListeners(array $resource, ContainerInterface $container)
    {
        if (array_key_exists('listeners', $resource)) {
            $listeners = $resource['listeners'];

            foreach ($listeners as $listenerType => $listener) {
                if (!$container->has($listener)) {
                    throw new \RuntimeException(
                        sprintf(
                            'Invalid dany \'%s\' listener service. \'%s\' does not exist',
                            $listenerType,
                            $listener
                        )
                    );
                }
            }
        }
    }

    private function validateFlow(array $resource, ContainerInterface $container)
    {
        if (array_key_exists('flow', $resource)) {
            $flows = $resource['flow'];

            foreach ($flows as $flow) {
                if (!$container->has($flow)) {
                    throw new \RuntimeException(
                        sprintf(
                            'Nonexistent dany flow service. \'%s\' does not exist',
                            $flow
                        )
                    );
                }
            }
        }
    }

    private function addConfigurationToContainer(
        ContainerInterface $container,
        array $resources
    ) {
        $configFactory = new ResourceConfigurationBuilder($resources);

        $container->set('dany.resource_collection', $configFactory->buildConfiguration());
    }
}
