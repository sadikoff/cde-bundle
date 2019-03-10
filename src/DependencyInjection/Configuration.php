<?php

/*
 * This file is part of the Koff CdeBundle package.
 *
 * (c) Vladimir Sadicov <sadikoff@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Koff\Bundle\CdeBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder('koff_cde');
        $rootNode = $treeBuilder->getRootNode();

        $this->addMappingsSection($rootNode);
        $this->addFeaturesSection($rootNode);

        return $treeBuilder;
    }

    private function addMappingsSection(ArrayNodeDefinition $rootNode)
    {
        $rootNode
            ->children()
                ->arrayNode('mappings')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->arrayNode('translatable')
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->scalarNode('type')->defaultValue('annotation')->end()
                                ->scalarNode('alias')->defaultValue('Gedmo')->end()
                                ->booleanNode('is_bundle')->defaultFalse()->end()
                                ->scalarNode('prefix')->defaultValue('Gedmo\Translatable\Entity')->end()
                                ->scalarNode('dir')->defaultValue('%kernel.root_dir%/../vendor/gedmo/doctrine-extensions/lib/Gedmo/Translatable/Entity')->end()
                            ->end()
                        ->end()
                        ->arrayNode('loggable')
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->scalarNode('type')->defaultValue('annotation')->end()
                                ->scalarNode('alias')->defaultValue('Gedmo')->end()
                                ->booleanNode('is_bundle')->defaultFalse()->end()
                                ->scalarNode('prefix')->defaultValue('Gedmo\Loggable\Entity')->end()
                                ->scalarNode('dir')->defaultValue('%kernel.root_dir%/../vendor/gedmo/doctrine-extensions/lib/Gedmo/Loggable/Entity')->end()
                            ->end()
                        ->end()
                        ->arrayNode('tree')
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->scalarNode('type')->defaultValue('annotation')->end()
                                ->scalarNode('alias')->defaultValue('Gedmo')->end()
                                ->booleanNode('is_bundle')->defaultFalse()->end()
                                ->scalarNode('prefix')->defaultValue('Gedmo\Tree\Entity')->end()
                                ->scalarNode('dir')->defaultValue('%kernel.root_dir%/../vendor/gedmo/doctrine-extensions/lib/Gedmo/Tree/Entity')->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;
    }

    private function addFeaturesSection(ArrayNodeDefinition $rootNode)
    {
        $rootNode
            ->children()
                ->arrayNode('features')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->booleanNode('blameable')->defaultFalse()->end()
                        ->booleanNode('ip_traceable')->defaultFalse()->end()
                        ->booleanNode('loggable')->defaultFalse()->end()
                        ->booleanNode('sluggable')->defaultFalse()->end()
                        ->booleanNode('soft_deletable')->defaultFalse()->end()
                        ->booleanNode('timestampable')->defaultFalse()->end()
                        ->booleanNode('translatable')->defaultFalse()->end()
                        ->booleanNode('tree')->defaultFalse()->end()
                        ->booleanNode('uploadable')->defaultFalse()->end()
                    ->end()
                ->end()
            ->end()
        ;
    }
}
