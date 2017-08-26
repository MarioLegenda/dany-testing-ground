<?php

namespace Dany\Bundle\DanyBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files.
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/configuration.html}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('dany');

        // Here you should define the parameters that are allowed to
        // configure your bundle. See the documentation linked above for
        // more information on that topic.

        $rootNode
            ->children()
                ->arrayNode('resources')
                    ->useAttributeAsKey('name')
                    ->prototype('array')
                        ->children()
                            ->scalarNode('model')->defaultNull()->end()
                            ->arrayNode('models')->prototype('scalar')->defaultNull()->end()->end()
                            ->arrayNode('listeners')
                                ->children()
                                    ->scalarNode('pre_flow')->defaultNull()->end()
                                    ->scalarNode('post_flow')->defaultNull()->end()
                                ->end()
                            ->end()
                            ->arrayNode('flow')->prototype('scalar')->defaultNull()->end()->end()
                        ->end()
                    ->end()
                ->end()
            ->end();

        return $treeBuilder;
    }
}
