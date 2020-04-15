<?php

namespace app\modules\api\bootstrap;

use app\modules\api\activeRecords\Category;
use app\modules\api\activeRecords\Post;
use app\modules\api\repositories\CategoryRepository;
use app\modules\api\repositories\PostRepository;
use Yii;

class Repositories
{
    public function registerRepositories()
    {
        Yii::$container->set(
            CategoryRepository::class,
            function () {
                return new CategoryRepository(Category::class);
            }
        );
        Yii::$container->set(
            PostRepository::class,
            function () {
                return new PostRepository(Post::class);
            }
        );
    }
}
