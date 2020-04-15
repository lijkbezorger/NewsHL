<?php

namespace app\modules\api\search;

use app\modules\api\activeRecords\Post;
use yii\data\ActiveDataProvider;

class PostSearch extends Post
{
    /**
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search(array $params): ActiveDataProvider
    {
        $query = Post::find()
            ->with(['category']);

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
            'id'          => $this->id,
            'isPublished' => $this->isPublished,
        ]);

        return $dataProvider;
    }
}
