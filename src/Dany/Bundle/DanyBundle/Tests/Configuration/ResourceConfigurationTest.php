<?php

namespace Dany\Bundle\DanyBundle\Tests\Configuration;

use Dany\Bundle\DanyBundle\Configuration\FlowConfigurationInterface;
use Dany\Bundle\DanyBundle\Configuration\ListenerConfigurationInterface;
use Dany\Bundle\DanyBundle\Configuration\ResourceConfigurationBuilder;
use Dany\Bundle\DanyBundle\Configuration\ResourceConfigurationInterface;
use Dany\Bundle\DanyBundle\Configuration\DanyRoute;
use Dany\Bundle\DanyBundle\Configuration\RoutingConfigurationInterface;
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

            $this->assertTrue($resource->hasRoutingConfiguration());
            $this->assertTrue($resource->hasModelConfiguration());
            $this->assertFalse($resource->hasListenerConfiguration());
            $this->assertFalse($resource->hasFlowConfiguration());
        }

        $categoryApp = $configurationCollection->get('app.category');

        $routeConfig = $categoryApp->getRoutingConfiguration();

        $this->assertInstanceOf(RoutingConfigurationInterface::class, $routeConfig);
        $this->assertTrue($routeConfig->hasRoute('category_list'));
        $this->assertInstanceOf(DanyRoute::class, $routeConfig->getRoute('category_list'));
        $this->assertInternalType('string', $routeConfig->getRoute('category_list')->getPath());

        $route = $routeConfig->getRoute('category_list');

        $this->assertEquals('category_list', $route->getName());
        $this->assertTrue($route->hasPath());
        $this->assertFalse($route->hasRequirements());
        $this->assertTrue($route->hasMethods());
        $this->assertFalse($route->hasHost());
        $this->assertFalse($route->hasCondition());
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

        $categoryApp = $configurationCollection->get('app.category');

        $routeConfig = $categoryApp->getRoutingConfiguration();

        $this->assertInstanceOf(RoutingConfigurationInterface::class, $routeConfig);
        $this->assertTrue($routeConfig->hasRoute('category_list'));
        $this->assertInstanceOf(DanyRoute::class, $routeConfig->getRoute('category_list'));
        $this->assertInternalType('string', $routeConfig->getRoute('category_list')->getPath());

        $route = $routeConfig->getRoute('category_list');

        $this->assertEquals('category_list', $route->getName());
        $this->assertTrue($route->hasPath());
        $this->assertTrue($route->hasRequirements());
        $this->assertTrue($route->hasMethods());
        $this->assertTrue($route->hasHost());
        $this->assertTrue($route->hasCondition());

        $this->assertInternalType('array', $route->getRequirements());
        $this->assertInternalType('string', $route->getHost());
        $this->assertInternalType('array', $route->getMethods());
    }
}