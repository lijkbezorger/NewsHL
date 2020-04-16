<?php

namespace app\modules\api\repositories;

use app\modules\api\filters\CategoryFilter;
use yii\db\ActiveRecord;

class CategoryRepository extends AbstractRepository
{
    /**
     * @param CategoryFilter $filter
     *
     * @return array|ActiveRecord[]
     */
    public function findList(CategoryFilter $filter)
    {
        $query = $this->ar::find();
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
            ->with(['postsAmount'])
            ->andWhere($condition)
            ->one();
    }
}
