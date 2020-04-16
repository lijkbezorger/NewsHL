<?php

namespace app\modules\api\repositories;

use app\modules\api\filters\CategoryFilter;
use yii\db\ActiveRecord;

class CategoryRepository extends AbstractCategoryRepository implements CategoryRepositoryInterface
{
    /** @inheritDoc */
    public function findList(CategoryFilter $filter): array
    {
        $query = $this->ar::find();
        $query->limit($filter->getPageSize());
        $query->addPostsAmount();
        if ($filter->getPage()) {
            $query->offset($filter->getPageSize() * ($filter->getPage() - 1));
        }

        return $query->all();
    }

    /**
     * @return ActiveRecord
     */
    public function findOneByCondition($condition)
    {
        return $this->ar::find()
            ->applyCondition($condition)
            ->addPostsAmount()
            ->one();
    }

    /**
     * @param $model ActiveRecord
     *
     * @param bool $validation
     *
     * @return ActiveRecord|null
     */
    public function save(ActiveRecord $model, bool $validation = false)
    {
        $entity = null;

        $saveResult = $model->save($validation);
        if ($saveResult) {
            $entity = $model;
        }

        return $entity;
    }

    /**
     * @param ActiveRecord $model
     *
     * @return bool|false|int|mixed
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function deleteByObject(ActiveRecord $model)
    {
        return $model->delete();
    }
}
