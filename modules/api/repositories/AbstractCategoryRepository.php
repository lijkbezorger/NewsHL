<?php

namespace app\modules\api\repositories;

use app\modules\api\activeRecords\Category;
use yii\db\ActiveRecord;

class AbstractCategoryRepository
{
    /** @var string|ActiveRecord */
    protected $ar;

    public function __construct()
    {
        $this->ar = Category::class;
    }
}
