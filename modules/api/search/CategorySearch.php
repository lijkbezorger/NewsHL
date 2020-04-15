<?php

namespace app\modules\api\search;

use app\modules\api\activeRecords\Category;
use app\modules\api\data\CustomDataProvider;
use app\modules\api\mappers\CategoryMapper;
use yii\data\ActiveDataProvider;

class CategorySearch extends Category
{
    /** @var CategoryMapper */
    private $categoryMapper;

    /**
     * CategorySearch constructor.
     *
     * @param CategoryMapper $categoryMapper
     */
    public function __construct(CategoryMapper $categoryMapper)
    {
        $this->categoryMapper = $categoryMapper;
        parent::__construct();
    }

    /**
     * @return array
     */
    public function rules()
    {
        return [
            [['isActive'], 'integer'],
            [['name'], 'string', 'max' => 100],
        ];
    }

    /**
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search(array $params): ActiveDataProvider
    {
        $query = Category::find();

        $dataProvider = new CustomDataProvider([
            'query'      => $query,
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);
        $dataProvider->setCategoryMapper($this->categoryMapper);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id'       => $this->id,
            'isActive' => $this->isActive,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
}
