<?php

namespace app\modules\api\queries;

use app\modules\api\activeRecords\Post;
use yii\db\Expression;

/**
 * This is the ActiveQuery class for [[\app\modules\api\activeRecords\Category]].
 *
 * @see \app\modules\api\activeRecords\Category
 */
class CategoryQuery extends \yii\db\ActiveQuery
{
    const ALIAS = 'category';

    /**
     * {@inheritdoc}
     * @return \app\modules\api\activeRecords\Category[]|array
     */
    public function all($db = null)
    {
        $this->alias(self::ALIAS);

        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \app\modules\api\activeRecords\Category|array|null
     */
    public function one($db = null)
    {
        $this->alias(self::ALIAS);

        return parent::one($db);
    }

    /**
     * @param array $condition
     *
     * @return $this
     */
    public function applyCondition(array $condition)
    {
        $fixedCondition = [];
        foreach ($condition as $key => $value) {
            $fixedCondition[self::ALIAS . '.' . $key] = $value;
        }
        $this->andWhere($fixedCondition);

        return $this;
    }

    public function addPostsAmount()
    {
        $this->select([
            self::ALIAS . '.*',
            new Expression('COUNT(' . Post::tableName() . '.id) as postsAmount'),
        ])->leftJoin(Post::tableName(), self::ALIAS . '.id = ' . Post::tableName() . '.categoryId')
            ->groupBy(self::ALIAS . '.id');

        return $this;
    }
}
