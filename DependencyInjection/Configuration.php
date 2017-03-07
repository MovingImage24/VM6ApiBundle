<?php

namespace MovingImage\Bundle\VM6ApiBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    /**
     * @const Which API base URL to use by default.
     */
    const DEFAULT_API_BASE_URL = 'https://api.edge-cdn.net/rest/latest/';

    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('vm6_api');

        $rootNode
            ->children()
                ->scalarNode('base_url')
                    ->defaultValue(self::DEFAULT_API_BASE_URL)
                ->end()
                ->arrayNode('credentials')
                    ->isRequired()
                    ->children()
                        ->scalarNode('apiKey')->isRequired()->end()
                        ->scalarNode('developerKey')->isRequired()->end()
                        ->scalarNode('clientKey')->isRequired()->end()
                        ->scalarNode('signingKey')->defaultNull()->end()
                ->end()
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}