<?php

namespace app\modules\api\mappers;

use app\modules\api\activeRecords\Category;
use app\modules\api\models\Category as CategoryApi;

class CategoryMapper implements Mapper
{
    /**
     * @param Category $model
     *
     * @return CategoryApi
     */
    public function map($model): CategoryApi
    {
        $category = new CategoryApi();
        $category->id = $model->id;
        $category->name = $model->name;
        $category->isActive = $model->isActive;

        return $category;
    }
}
