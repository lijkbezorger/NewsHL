<?php
$db = require __DIR__ . '/db.php';

return [
    'request'      => [
        // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
        'cookieValidationKey' => 'SNU_FZ3tkHXeuHBYoX2ETZddHTt2D79h',
        'parsers'             => [
            'application/json' => 'yii\web\JsonParser',
        ],
    ],
    'cache'        => [
        'class' => 'yii\caching\FileCache',
    ],
    'user'         => [
        'identityClass'   => 'app\models\User',
        'enableAutoLogin' => true,
    ],
    'errorHandler' => [
        'errorAction' => 'site/error',
    ],
    'log'          => [
        'traceLevel' => YII_DEBUG ? 3 : 0,
        'targets'    => [
            [
                'class'  => 'yii\log\FileTarget',
                'levels' => ['error', 'warning'],
            ],
        ],
    ],
    'urlManager'   => [
        'enablePrettyUrl' => true,
        'showScriptName'  => false,
    ],
    'db'           => $db,
];
