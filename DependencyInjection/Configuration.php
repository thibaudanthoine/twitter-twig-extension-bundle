<?php

namespace Thibaud\TwitterTwigExtensionBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();

        $treeBuilder->root('thibaud_twitter_twig_extension')
            ->children()
                ->booleanNode('enabled')->defaultFalse()->end()
                ->scalarNode('lang')->defaultValue('%locale%')->end()
                ->booleanNode('large')->defaultTrue()->end()
                ->arrayNode('buttons')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->arrayNode('share')
                            ->children()
                                ->booleanNode('show_count')->defaultTrue()->end()
                            ->end()
                        ->end()
                        ->arrayNode('follow')
                            ->children()
                                ->scalarNode('username')->end()
                                ->booleanNode('show_username')->defaultTrue()->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
