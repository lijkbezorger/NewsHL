<?php

namespace app\modules\api\repositories;

use app\modules\api\filters\PostFilter;
use yii\db\ActiveRecord;

interface PostRepositoryInterface
{
    /**
     * @param PostFilter $filter
     *
     * @return array
     */
    public function findList(PostFilter $filter): array;

    /**
     * @param $condition
     *
     * @return mixed
     */
    public function findFullOneByCondition($condition);

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
