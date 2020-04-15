<?php

namespace app\modules\api\bootstrap;

use yii\rest\UrlRule;
use yii\web\Application;

class Routes
{
    public function registerRoutes(Application $app): void
    {
        $app->urlManager->addRules([
            'api/v1/categories' => 'api/category/index',
            [
                'class'      => UrlRule::class,
                'controller' => [
                    'api/v1/category' => 'api/category',
                ],
                'patterns'   => [
                    'GET {id}'    => 'view',
                    'POST'        => 'create',
                    'PUT {id}'    => 'update',
                    'DELETE {id}' => 'delete',
                ],
                'tokens'     => [
                    '{id}' => "<id:\d[\d,]*>",
                ],
            ],
            'api/v1/posts'      => 'api/post/index',
            [
                'class'      => UrlRule::class,
                'controller' => [
                    'api/v1/post' => 'api/post',
                ],
                'patterns'   => [
                    'GET {id}'       => 'view',
                    'POST'           => 'create',
                    'PUT,PATCH {id}' => 'update',
                    'DELETE {id}'    => 'delete',
                ],
                'tokens'     => [
                    '{id}' => "<id:\d[\d,]*>",
                ],
            ],
        ]);
        $app->urlManager->addRules(['/api/v1/doc' => '/api/doc/doc']);
        $app->urlManager->addRules(['/api/v1/json' => '/api/doc/json']);
    }
}
