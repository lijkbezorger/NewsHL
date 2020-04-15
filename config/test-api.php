<?php
$bootstrap = require __DIR__ . '/bootstrap.php';
$components = require __DIR__ . '/components-test.php';
$modules = require __DIR__ . '/modules.php';
$params = require __DIR__ . '/params.php';

/**
 * Application configuration shared by all test types
 */
return [
    'id'               => 'api-tests',
    'basePath'         => dirname(__DIR__),
    'vendorPath'       => dirname(__DIR__) . '/vendor',
    'runtimePath'      => dirname(__DIR__) . '/runtime',
    'aliases'          => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
        '@src'   => dirname(__DIR__) . '/src',
    ],
    'language'         => 'en-US',
    'on beforeRequest' => function () {
        $app = Yii::$app;
        $request = $app->request;
        if (strpos($request->getUrl(), '/api/') !== false) {
            $request->enableCsrfValidation = false;
            $request->enableCookieValidation = false;
            $request->enableCsrfCookie = false;

            $app->user->enableSession = false;
            $app->response->format = \yii\web\Response::FORMAT_JSON;
        }
    },
    'bootstrap'        => $bootstrap,
    'components'       => $components,
    'modules'          => $modules,
    'params'           => $params,
];
