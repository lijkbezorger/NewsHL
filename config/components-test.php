<?php
$db = require __DIR__ . '/test_db.php';

return [
    'db' => $db,
    'assetManager' => [
        'basePath' => __DIR__ . '/../web/assets',
    ],
    'urlManager' => [
        'showScriptName' => true,
    ],
    'user' => [
        'identityClass' => 'app\models\User',
    ],
    'request' => [
        'cookieValidationKey' => 'test',
        'enableCsrfValidation' => false,
        // but if you absolutely need it set cookie domain to localhost
        /*
        'csrfCookie' => [
            'domain' => 'localhost',
        ],
        */
    ],
];
