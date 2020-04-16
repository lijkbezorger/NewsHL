<?php

namespace app\modules\api\activeRecords;

use app\modules\api\queries\CategoryQuery;
use yii\db\Expression;

/**
 * This is the model class for table "category".
 *
 * @property int $id
 * @property string|null $name
 * @property int|null $isActive
 * @property int|null $createdAt
 * @property int|null $updatedAt
 *
 * @property Post[] $posts
 */
class Category extends \yii\db\ActiveRecord
{
    /** @var int */
    private $postsAmount = 0;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['createdAt', 'updatedAt'], 'integer'],
            [['isActive'], 'boolean'],
            [['name'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id'        => 'ID',
            'name'      => 'Name',
            'isActive'  => 'Is Active',
            'createdAt' => 'Created At',
            'updatedAt' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[Posts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPosts()
    {
        return $this->hasMany(Post::class, ['categoryId' => 'id']);
    }

    /** @return int */
    public function getPostsAmount(): int
    {
        return $this->postsAmount;
    }

    /** @param int $postsAmount */
    public function setPostsAmount(int $postsAmount): void
    {
        $this->postsAmount = $postsAmount;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public static function find()
    {
        return new CategoryQuery(get_called_class());
    }

    public function fields()
    {
        return [
            'id',
            'name',
            'isActive'    => function () {
                return (bool)$this->isActive;
            },
            'postsAmount' => function () {
                return $this->postsAmount;
            },
        ];
    }
}
