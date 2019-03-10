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

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration.
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class KoffCdeBundleExtension extends Extension implements PrependExtensionInterface
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
    }

    public function prepend(ContainerBuilder $container)
    {
        $configs = $container->getExtensionConfig($this->getAlias());
        $config = $this->processConfiguration(new Configuration(), $configs);
        // get main doctrine config
        $doctrine = $container->getExtensionConfig('doctrine')[0];
        $injectConfig = [];

        $loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.xml');

        $mappings = [];

        foreach ($config['listeners'] as $extension => $enabled) {
            $definitionKey = 'artemiso_doctrine_extra.listener.'.$extension;

            if ('translatable' == $extension && $enabled) {
                $mappings['ArtemisoTranslatable'] = $config['mappings']['translatable'];
            } else {
                $container->removeDefinition('artemiso_doctrine_extra.extension_translatable_listener');
            }

            if ('loggable' == $extension && $enabled) {
                $mappings['ArtemisoLoggable'] = $config['mappings']['loggable'];
            } else {
                $container->removeDefinition('artemiso_doctrine_extra.extension_loggable_listener');
            }

            if ('tree' == $extension && $enabled) {
                $mappings['ArtemisoTree'] = $config['mappings']['tree'];
            }

            if ($container->hasDefinition($definitionKey) && $enabled) {
                $container->getDefinition($definitionKey)->setPublic(true);
            }
        }

        if (\array_key_exists('auto_mapping', $doctrine['orm']) && $doctrine['orm']['auto_mapping']) {
            $injectConfig = ['orm' => ['mappings' => $mappings]];
        } elseif (\array_key_exists('entity_managers', $doctrine['orm']) && \is_array($doctrine['orm']['entity_managers'])) {
            $injectConfig = ['orm' => ['entity_managers' => []]];

            foreach ($doctrine['orm']['entity_managers'] as $em => $params) {
                $injectConfig['orm']['entity_managers'][$em] = ['mappings' => $mappings];
            }
        }

        if (!empty($injectConfig)) {
            $container->loadFromExtension('doctrine', $injectConfig);
        }
    }
}
