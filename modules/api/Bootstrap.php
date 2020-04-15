<?php

namespace app\modules\api;

use app\modules\api\bootstrap\Repositories;
use app\modules\api\bootstrap\Routes;
use yii\base\BootstrapInterface;
use yii\web\Application as WebApplication;

class Bootstrap implements BootstrapInterface
{
    public function bootstrap($app)
    {
        if ($app instanceof WebApplication) {
            /** @var Routes $routes */
            $routes = \Yii::createObject(Routes::class);
            $routes->registerRoutes($app);
        }

        /** @var Repositories $repositories */
        $repositories = \Yii::createObject(Repositories::class);
        $repositories->registerRepositories();
    }
}
