<?php
$components = require __DIR__ . '/components-test.php';
$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/test_db.php';

/**
 * Application configuration shared by all test types
 */
return [
    'id'         => 'basic-tests',
    'basePath'   => dirname(__DIR__),
    'aliases'    => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'language'   => 'en-US',
    'components' => $components,
    'params'     => $params,
];
