<?php

namespace app\modules\api\repositories;

use app\modules\api\filters\PostFilter;
use yii\db\ActiveRecord;

class PostRepository extends AbstractPostRepository implements PostRepositoryInterface
{
    /** @inheritDoc */
    public function findList(PostFilter $filter): array
    {
        $query = $this->ar::find();
        $query->with(['category']);
        $query->limit($filter->getPageSize());
        $query->orderBy(['id' => SORT_DESC]);
        if ($filter->getPage()) {
            $query->offset($filter->getPageSize() * ($filter->getPage() - 1));
        }

        return $query->all();
    }

    /**
     * @return ActiveRecord
     */
    public function findFullOneByCondition($condition)
    {
        return $this->ar::find()
            ->with(['category'])
            ->andWhere($condition)
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
