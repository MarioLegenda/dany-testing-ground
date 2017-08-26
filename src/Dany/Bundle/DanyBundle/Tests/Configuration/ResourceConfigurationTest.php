<?php

namespace Dany\Bundle\DanyBundle\Tests\Configuration;

use Dany\Bundle\DanyBundle\Configuration\FlowConfigurationInterface;
use Dany\Bundle\DanyBundle\Configuration\ListenerConfigurationInterface;
use Dany\Bundle\DanyBundle\Configuration\ResourceConfigurationBuilder;
use Dany\Bundle\DanyBundle\Configuration\ResourceConfigurationInterface;
use Dany\Library\CollectionInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Yaml\Yaml;
use Symfony\Component\Config\Definition\Processor;
use Dany\Bundle\DanyBundle\DependencyInjection\Configuration;

class ResourceConfigurationTest extends KernelTestCase
{
    public function test_resource_minimal_configuration()
    {
        $minimalDany = Yaml::parse(
            file_get_contents(__DIR__.'/config/minimal_valid_config.yml')
        );

        $processor = new Processor();
        $configuration = new Configuration();

        $processedConfiguration = $processor->processConfiguration(
            $configuration,
            $minimalDany
        );

        $configBuilder = new ResourceConfigurationBuilder(
            $processedConfiguration['resources']
        );

        $configurationCollection = $configBuilder->buildConfiguration();

        $this->assertInstanceOf(CollectionInterface::class, $configurationCollection);
        $this->assertCount(2, $configurationCollection);
        $this->assertTrue($configurationCollection->has('app.category'));
        $this->assertTrue($configurationCollection->has('app.word'));

        foreach ($configurationCollection as $resource) {
            $this->assertInstanceOf(
                ResourceConfigurationInterface::class,
                $resource
            );

            $this->assertTrue($resource->hasModelConfiguration());
            $this->assertFalse($resource->hasListenerConfiguration());
            $this->assertFalse($resource->hasFlowConfiguration());
        }
    }

    public function test_resource_full_configuration()
    {
        $minimalDany = Yaml::parse(
            file_get_contents(__DIR__.'/config/full_valid_config.yml')
        );

        $processor = new Processor();
        $configuration = new Configuration();

        $processedConfiguration = $processor->processConfiguration(
            $configuration,
            $minimalDany
        );

        $configBuilder = new ResourceConfigurationBuilder(
            $processedConfiguration['resources']
        );

        $configurationCollection = $configBuilder->buildConfiguration();

        $this->assertInstanceOf(CollectionInterface::class, $configurationCollection);
        $this->assertCount(2, $configurationCollection);
        $this->assertTrue($configurationCollection->has('app.category'));
        $this->assertTrue($configurationCollection->has('app.word'));

        foreach ($configurationCollection as $resource) {
            $this->assertInstanceOf(
                ResourceConfigurationInterface::class,
                $resource
            );

            $this->assertTrue($resource->hasModelConfiguration());
            $this->assertTrue($resource->hasListenerConfiguration());
            $this->assertTrue($resource->hasFlowConfiguration());

            $this->assertInstanceOf(
                ListenerConfigurationInterface::class,
                $resource->getListenerConfiguration()
            );

            $this->assertInstanceOf(
                FlowConfigurationInterface::class,
                $resource->getFlowConfiguration()
            );

            $this->assertInternalType(
                'string',
                $resource->getModelConfiguration()->getModel()
            );

            $this->assertInternalType(
                'array',
                $resource->getListenerConfiguration()->getListenerServices()
            );

            $this->assertInternalType(
                'array',
                $resource->getFlowConfiguration()->getFlowServices()
            );
        }
    }
}