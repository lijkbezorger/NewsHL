<?php

namespace app\modules\api\activeRecords;

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

    /**
     * @return bool|int|string|null
     */
    public function getPostsAmount()
    {
        return $this->getPosts()->count('id');
    }

    public function fields()
    {
        $posts = (int)$this->getPostsAmount();

        return [
            'id',
            'name',
            'isActive'    => function () {
                return (bool)$this->isActive;
            },
            'postsAmount' => function () use ($posts) {
                return $posts;
            },
        ];
    }
}
