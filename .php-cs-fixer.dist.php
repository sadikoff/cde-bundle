<?php

if (!file_exists(__DIR__.'/src')) {
    exit(0);
}

$finder = (new PhpCsFixer\Finder())
    ->in([
        __DIR__.'/src',
        __DIR__.'/tests',
    ])
;

return (new PhpCsFixer\Config())
    ->setRules([
        '@PHP81Migration' => true,
        '@PHPUnit84Migration:risky' => true,
        '@Symfony' => true,
        '@Symfony:risky' => true,
        'array_syntax' => ['syntax' => 'short'],
        'protected_to_private' => false,
        'semicolon_after_instruction' => false,
        'header_comment' => [
            'header' => <<<EOF
This file is part of the koff/cde-bundle package.

(c) Vladimir Sadicov <sadikoff@gmail.com>

For the full copyright and license information, please view the LICENSE
file that was distributed with this source code.
EOF
        ]
    ])
    ->setRiskyAllowed(true)
    ->setFinder($finder)
;
