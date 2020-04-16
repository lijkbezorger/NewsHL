<?php

namespace app\modules\api\bootstrap;

use app\modules\api\repositories\CategoryRepository;
use app\modules\api\repositories\CategoryRepositoryCached;
use app\modules\api\repositories\CategoryRepositoryInterface;
use app\modules\api\repositories\PostRepository;
use app\modules\api\repositories\PostRepositoryCached;
use app\modules\api\repositories\PostRepositoryInterface;
use Yii;

class Repositories
{
    public function registerRepositories()
    {
        if (Yii::$app->cache) {
            Yii::$container->set(CategoryRepositoryInterface::class, CategoryRepositoryCached::class);
            Yii::$container->set(PostRepositoryInterface::class, PostRepositoryCached::class);
        } else {
            Yii::$container->set(CategoryRepositoryInterface::class, CategoryRepository::class);
            Yii::$container->set(PostRepositoryInterface::class, PostRepository::class);
        }
    }
}
