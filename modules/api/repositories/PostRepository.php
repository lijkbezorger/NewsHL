<?php

namespace app\modules\api\repositories;

use app\modules\api\filters\PostFilter;
use yii\db\ActiveRecord;

class PostRepository extends AbstractRepository
{
    /**
     * @param PostFilter $filter
     *
     * @return array|ActiveRecord[]
     */
    public function findList(PostFilter $filter)
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
}
