<?php

require __DIR__ . '/../vendor/autoload.php';

// NOTE: Make sure this file is not accessible when deployed to production
if (!in_array(@$_SERVER['REMOTE_ADDR'], ['127.0.0.1', '::1'])) {
    die('You are not allowed to access this file.');
}

Dotenv::load(__DIR__ . '/..');
Dotenv::required(['DB_HOST', 'DB_NAME', 'DB_USER', 'DB_PASS', 'YII_DEBUG', 'YII_MAIL_USE_FILE_TRANSPORT']);

defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'test');
defined('YII_CLI') or define('YII_CLI', false);
defined('YII_MAIL_USE_FILE_TRANSPORT') or define('YII_MAIL_USE_FILE_TRANSPORT', getenv('YII_MAIL_USE_FILE_TRANSPORT') == 'true');

require __DIR__ . '/../vendor/yiisoft/yii2/Yii.php';

$config = require __DIR__ . '/../tests/config/test_api.php';
(new yii\web\Application($config))->run();
