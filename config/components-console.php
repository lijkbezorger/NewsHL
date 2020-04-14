<?php
$db = require __DIR__ . '/db.php';

return [
    'cache' => [
        'class' => 'yii\caching\FileCache',
    ],
    'log'   => [
        'targets' => [
            [
                'class'  => 'yii\log\FileTarget',
                'levels' => ['error', 'warning'],
            ],
        ],
    ],
    'db'    => $db,
];
