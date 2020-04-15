<?php

namespace app\modules\api\repositories;

use yii\db\ActiveRecord;

class CategoryRepository extends AbstractRepository
{
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
