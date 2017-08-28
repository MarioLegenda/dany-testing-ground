<?php

namespace Dany\Bundle\DanyBundle\DependencyInjection\Definition;

use Symfony\Component\DependencyInjection\ContainerBuilder;

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
            ->addConfigurtionBuilder();
    }

    private function addConfigurtionBuilder() : DefinitionFactory
    {
        $builderDefinition = $this->containerBuilder->getDefinition('dany.resource_configuration_builder');
        $builderDefinition->addArgument($this->config['resources']);

        return $this;
    }
}