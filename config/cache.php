<?php

return [
    'class'        => 'yii\caching\MemCache',
    'useMemcached' => true,
    'servers'      => [
        [
            'host'   => getenv('MC_HOST'),
            'port'   => getenv('MC_PORT'),
        ],
    ],
];
