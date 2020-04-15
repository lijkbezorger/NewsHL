<?php

namespace app\modules\api\activeRecords;

/**
 * This is the model class for table "post".
 *
 * @property int $id
 * @property string|null $content
 * @property string|null $preview
 * @property int|null $isPublished
 * @property int|null $publishedAt
 * @property int|null $categoryId
 * @property int|null $createdAt
 * @property int|null $updatedAt
 *
 * @property Category $category
 */
class Post extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'post';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['content'], 'string'],
            [['publishedAt', 'categoryId', 'createdAt', 'updatedAt'], 'integer'],
            [['isPublished'], 'boolean'],
            [['preview'], 'string', 'max' => 255],
            [
                ['categoryId'],
                'exist',
                'skipOnError'     => true,
                'targetClass'     => Category::class,
                'targetAttribute' => ['categoryId' => 'id'],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id'          => 'ID',
            'content'     => 'Content',
            'preview'     => 'Preview',
            'isPublished' => 'Is Published',
            'publishedAt' => 'Published At',
            'categoryId'  => 'Category ID',
            'createdAt'   => 'Created At',
            'updatedAt'   => 'Updated At',
        ];
    }

    /**
     * Gets query for [[Category]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::class, ['id' => 'categoryId']);
    }

    public function fields()
    {
        $related = $this->getRelatedRecords();
        $category = $related['category'] ?? null;

        return [
            'id',
            'content',
            'preview',
            'isPublished',
            'publishedAt',
            'category' => function () use ($category) {
                if ($category) {
                    return [
                        'id'   => $category->id,
                        'name' => $category->name,
                    ];
                }

                return [];
            },
        ];
    }
}
