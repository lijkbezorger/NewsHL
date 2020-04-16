<?php

$bootstrap = require __DIR__ . '/bootstrap.php';
$modules = require __DIR__ . '/modules.php';
$components = require __DIR__ . '/components-console.php';
$params = require __DIR__ . '/params.php';

$config = [
    'id'                  => 'basic-console',
    'basePath'            => dirname(__DIR__),
    'aliases'             => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
        '@tests' => '@app/tests',
    ],
    'controllerNamespace' => 'app\commands',
    'bootstrap'           => $bootstrap,
    'components'          => $components,
    'modules'             => $modules,
    'params'              => $params,

    'controllerMap' => [
        'fixture' => [
            'class'           => 'yii\faker\FixtureController',
            'templatePath'    => '@tests/fixtures/templates',
            'fixtureDataPath' => '@tests/fixtures/data',
            'namespace'       => 'tests\fixtures',
        ],
    ],
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

return $config;
