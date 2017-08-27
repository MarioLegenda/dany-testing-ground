<?php

namespace Dany\Bundle\DanyBundle\Tests\DependencyInjection;

use Dany\Bundle\DanyBundle\DependencyInjection\Configuration;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Config\Definition\Processor;
use Symfony\Component\Process\Process;
use Symfony\Component\Yaml\Yaml;

class ConfigurationTest extends KernelTestCase
{
    public function test_minimal_dany_configuration()
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

        $categoryApp = $processedConfiguration['resources']['app.category'];

        $this->assertEquals('AppBundle\Entity\Category', $categoryApp['model']);
        $this->assertEmpty($categoryApp['models']);
        $this->assertEmpty($categoryApp['flow']);
        $this->assertArrayNotHasKey('listeners', $categoryApp);

        $this->assertArrayHasKey('routing', $categoryApp);
        $this->assertNotEmpty($categoryApp['routing']);
    }

    public function test_full_configuration()
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

        $categoryApp = $processedConfiguration['resources']['app.category'];

        $this->assertNotEmpty($categoryApp['routing']);
        $this->assertEmpty($categoryApp['models']);
        $this->assertNotEmpty($categoryApp['listeners']);
        $this->assertNotEmpty($categoryApp['flow']);
        $this->assertNotEmpty($categoryApp['model']);
    }
}