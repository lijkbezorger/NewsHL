<?php

namespace app\modules\api\repositories;

use app\modules\api\filters\CategoryFilter;
use yii\db\ActiveRecord;

interface CategoryRepositoryInterface
{
    /**
     * @param CategoryFilter $filter
     *
     * @return array
     */
    public function findList(CategoryFilter $filter): array;

    /**
     * @param $condition
     *
     * @return mixed
     */
    public function findOneByCondition($condition);

    /**
     * @param ActiveRecord $model
     * @param bool $validation
     *
     * @return mixed
     */
    public function save(ActiveRecord $model, bool $validation = false);

    /**
     * @param ActiveRecord $model
     *
     * @return mixed
     */
    public function deleteByObject(ActiveRecord $model);
}
