<?php

namespace tests\fixtures\activeRecords;

use app\modules\api\activeRecords\Post;
use yii\test\ActiveFixture;

class PostFixture extends ActiveFixture
{
    use FixtureDataTrait;

    public $modelClass = Post::class;

    public $dataFile = __DIR__ . '/../data/post.php';

    public $depends = [CategoryFixture::class];
}
