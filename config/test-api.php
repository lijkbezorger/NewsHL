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
    'components' => $components,
    'params'     => $params,
];
