<?php

/*
 * This document has been generated with
 * https://mlocati.github.io/php-cs-fixer-configurator/#version:3.0.2|configurator
 * you can change this configuration by importing this file.
 */
$config = new PhpCsFixer\Config();
return $config->setRules([
         '@PSR12' => true,                                    // Use PSR-2 formatting by default.
         'trailing_comma_in_multiline' => true,        // PHP multi-line arrays should have a trailing comma.
         'ordered_imports' => true,                          // Ordering use statements (alphabetically)
         'blank_line_before_statement' => true,                 // An empty line feed should precede a return statement
         'array_syntax' => ['syntax' => 'short'],            // PHP arrays should use the PHP 5.4 short-syntax.
         'short_scalar_cast' => true,                        // Cast "(boolean)" and "(integer)" should be written as "(bool)" and "(int)". "(double)" and "(real)" as "(float)".
         'single_blank_line_before_namespace' => true,       // An empty line feed should precede the namespace.
         'blank_line_after_opening_tag' => true,             // An empty line feed should follow a PHP open tag.
         'no_unused_imports' => true,                        // Unused use statements must be removed.
         'trim_array_spaces' => true,                        // Arrays should be formatted like function/method arguments, without leading or trailing single line space.
         'no_trailing_comma_in_singleline_array' => true,    // PHP single-line arrays should not have a trailing comma.
         'phpdoc_order' => true,
         'phpdoc_add_missing_param_annotation' => true,
         'phpdoc_annotation_without_dot' => true,
         'phpdoc_var_annotation_correct_order' => true,
         'phpdoc_indent' => true,
         'phpdoc_line_span' =>  true,
         'ternary_operator_spaces' => true,                  // Standardize spaces around ternary operator.
    ])
    ->setFinder(
        PhpCsFixer\Finder::create()->exclude('vendor')->in(__DIR__.DIRECTORY_SEPARATOR.'app')
            ->in(__DIR__.DIRECTORY_SEPARATOR.'tests')
);
