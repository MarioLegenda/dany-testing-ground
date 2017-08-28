<?php

namespace Dany\Bundle\DanyBundle\DependencyInjection\Definition;

use Dany\Bundle\DanyBundle\Repository\DanyEntityRepository;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Reference;

class DefinitionFactory
{
    /**
     * @var ContainerBuilder $containerBuilder
     */
    private $containerBuilder;

    /**
     * @var array $config
     */
    private $config;

    /**
     * DefinitionFactory constructor.
     * @param ContainerBuilder $containerBuilder
     * @param array $config
     */
    public function __construct(
        ContainerBuilder $containerBuilder,
        array $config
    ) {
        $this->containerBuilder = $containerBuilder;
        $this->config = $config;
    }

    /**
     * @void
     */
    public function addDefinitions()
    {
        $this
            ->addConfigurationBuilder()
            ->addRepositoryClasses();
    }

    private function addConfigurationBuilder() : DefinitionFactory
    {
        $builderDefinition = $this->containerBuilder->getDefinition('dany.resource_configuration_builder');
        $builderDefinition->addArgument($this->config['resources']);

        return $this;
    }

    private function addRepositoryClasses()
    {
        $resources = $this->config['resources'];
        foreach ($resources as $resourceName => $resource) {
            $definition = new Definition(DanyEntityRepository::class);

            $definition->addArgument(new Reference('doctrine.orm.entity_manager'));
            $definition->addArgument($resource['model']);

            $serviceId = sprintf('%s.repository', $resourceName);

            $this->containerBuilder->setDefinition($serviceId, $definition);
        }
    }
}