<?php

/*
 * This file is part of the koff/cde-bundle package.
 *
 * (c) Vladimir Sadicov <sadikoff@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Koff\CdeBundle\Tests\DependencyInjection;

use Koff\CdeBundle\DependencyInjection\Configuration;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Config\Definition\Processor;

class ConfigurationTest extends TestCase
{
    public function testDefaultConfig(): void
    {
        $processor = new Processor();
        $config = $processor->processConfiguration(new Configuration(), []);

        self::assertEquals(self::getBundleDefaultConfig(), $config);
    }

    private static function getBundleDefaultConfig(): array
    {
        return [
            'mappings' => [
                'translatable' => [
                    'type' => 'annotation',
                    'alias' => 'Gedmo',
                    'is_bundle' => false,
                    'prefix' => 'Gedmo\\Translatable\\Entity',
                    'dir' => '%kernel.project_dir%/vendor/gedmo/doctrine-extensions/src/Translatable/Entity',
                ],
                'loggable' => [
                    'type' => 'annotation',
                    'alias' => 'Gedmo',
                    'is_bundle' => false,
                    'prefix' => 'Gedmo\\Loggable\\Entity',
                    'dir' => '%kernel.project_dir%/vendor/gedmo/doctrine-extensions/src/Loggable/Entity',
                ],
                'sortable' => [
                    'type' => 'annotation',
                    'alias' => 'Gedmo',
                    'is_bundle' => false,
                    'prefix' => 'Gedmo\\Sortable\\Entity',
                    'dir' => '%kernel.project_dir%/vendor/gedmo/doctrine-extensions/src/Sortable/Entity',
                ],
                'tree' => [
                    'type' => 'annotation',
                    'alias' => 'Gedmo',
                    'is_bundle' => false,
                    'prefix' => 'Gedmo\\Tree\\Entity',
                    'dir' => '%kernel.project_dir%/vendor/gedmo/doctrine-extensions/src/Tree/Entity',
                ],
            ],
            'features' => [
                'blameable' => false,
                'ip_traceable' => false,
                'loggable' => false,
                'sluggable' => false,
                'soft_deletable' => false,
                'timestampable' => false,
                'translatable' => false,
                'tree' => false,
                'uploadable' => false,
                'sortable' => false,
                'references' => false,
                'reference_integrity' => false,
            ],
        ];
    }
}
