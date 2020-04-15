<?php

Dotenv::load(getcwd(). '/');

return [
    'class'    => yii\db\Connection::class,
    'dsn'      => getenv('DB_DRIVER') .
        ':host=' . getenv('DB_HOST') .
        ';dbname=' . getenv('DB_NAME') .
        '_test',
    'username' => getenv('DB_USER'),
    'password' => getenv('DB_PASS'),
    'charset'  => 'utf8',
];

