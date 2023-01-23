<?php

$header = <<<'HEADER'
This file is part of the bolivir/vat project.
(c) Ricardo Mosselman <mosselmanricardo@gmail.com>
For the full copyright and license information, please view the LICENSE
file that was distributed with this source code.
HEADER;

$finder = Symfony\Component\Finder\Finder::create()
    ->notPath('vendor')
    ->notPath('tests/API/endpoints/_support/_generated')
    ->in(__DIR__)
    ->name('*.php');

return (new PhpCsFixer\Config())
    ->setRules([
        '@PSR2' => true,
        '@PhpCsFixer' => true,
        'php_unit_test_class_requires_covers' => false,
        'multiline_whitespace_before_semicolons' => ['strategy' => 'no_multi_line'],
        'php_unit_method_casing' => ['case' => 'snake_case'],
        'trailing_comma_in_multiline' => true,
        'class_attributes_separation' => ['elements' => [
            'const' => 'one',
            'method' => 'one',
            'property' => 'one',
            'trait_import' => 'none',
        ],
        ],
        'no_superfluous_phpdoc_tags' => [
            'allow_mixed' => true,
        ],
        'phpdoc_to_comment' => [
            'ignored_tags' => ['deprecated'],
        ],
        'global_namespace_import' => [
            'import_classes' => true,
            'import_constants' => true,
            'import_functions' => true,
        ],
        'header_comment' => [
            'header' => $header,
            'location' => 'after_open',
        ],
    ])
    ->setFinder($finder);
