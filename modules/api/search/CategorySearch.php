<?php

namespace app\modules\api\search;

use app\modules\api\activeRecords\Category;
use yii\data\ActiveDataProvider;

class CategorySearch extends Category
{
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

        $dataProvider = new ActiveDataProvider([
            'query'      => $query,
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);

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
