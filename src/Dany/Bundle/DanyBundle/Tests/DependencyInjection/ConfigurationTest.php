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

        $configs = array($minimalDany);

        $processor = new Processor();
        $configuration = new Configuration();

        $processedConfiguration = $processor->processConfiguration(
            $configuration,
            $configs
        );

        dump($processedConfiguration);
        die();
    }
}