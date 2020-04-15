<?php

namespace tests\fixtures\activeRecords;

use app\modules\api\activeRecords\Category;
use yii\test\ActiveFixture;

class CategoryFixture extends ActiveFixture
{
    use FixtureDataTrait;

    public $modelClass = Category::class;

    public $dataFile = __DIR__ . '/../data/category.php';
}
