<?php

namespace app\modules\api\repositories;

use yii\db\ActiveRecord;

class PostRepository extends AbstractRepository
{
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
