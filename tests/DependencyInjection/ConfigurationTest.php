<?php

namespace Koff\Bundle\CdeBundle\Test\DependencyInjection;

use Koff\Bundle\CdeBundle\DependencyInjection\Configuration;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Config\Definition\Processor;

class ConfigurationTest extends TestCase
{
    public function testDefaultConfig()
    {
        $processor = new Processor();
        $config    = $processor->processConfiguration(new Configuration(), []);

        $this->assertEquals(self::getBundleDefaultConfig(), $config);
    }

    private static function getBundleDefaultConfig()
    {
        return [
            "mappings"  => [
                "translatable" => [
                    "type"      => "annotation",
                    "alias"     => "Gedmo",
                    "is_bundle" => false,
                    "prefix"    => "Gedmo\Translatable\Entity",
                    "dir"       => "%kernel.root_dir%/../vendor/gedmo/doctrine-extensions/lib/Gedmo/Translatable/Entity",
                ],
                "loggable"     => [
                    "type"      => "annotation",
                    "alias"     => "Gedmo",
                    "is_bundle" => false,
                    "prefix"    => "Gedmo\Loggable\Entity",
                    "dir"       => "%kernel.root_dir%/../vendor/gedmo/doctrine-extensions/lib/Gedmo/Loggable/Entity",
                ],
                "tree"         => [
                    "type"      => "annotation",
                    "alias"     => "Gedmo",
                    "is_bundle" => false,
                    "prefix"    => "Gedmo\Tree\Entity",
                    "dir"       => "%kernel.root_dir%/../vendor/gedmo/doctrine-extensions/lib/Gedmo/Tree/Entity",
                ],
            ],
            "features" => [
                "blameable"      => false,
                "ip_traceable"   => false,
                "loggable"       => false,
                "sluggable"      => false,
                "soft_deletable" => false,
                "timestampable"  => false,
                "translatable"   => false,
                "tree"           => false,
                "uploadable"     => false,
            ]
        ];
    }
}
