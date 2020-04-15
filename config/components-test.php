<?php
Dotenv::load(getcwd(). '/');
$db = require __DIR__ . '/test_db.php';

return [
    'assetManager' => [
        'basePath' => __DIR__ . '/../web/assets',
    ],
    'urlManager'   => [
        'enablePrettyUrl' => true,
        'showScriptName'  => false,
    ],
    'user'         => [
        'identityClass' => 'app\models\User',
    ],
    'request'      => [
        'cookieValidationKey'  => 'test',
        'enableCsrfValidation' => false,
        'parsers'             => [
            'application/json' => 'yii\web\JsonParser',
        ],
    ],
    'db'           => $db,
];
