<?php

namespace app\modules\api\data;

use app\modules\api\mappers\Mapper;
use yii\data\ActiveDataProvider;

class CustomDataProvider extends ActiveDataProvider
{
    /** @var Mapper */
    private $mapper;

    /**
     * @param Mapper $mapper
     */
    public function setCategoryMapper(Mapper $mapper): void
    {
        $this->mapper = $mapper;
    }

    protected function prepareModels()
    {
        $models = parent::prepareModels();
        $list = [];
        foreach ($models as $model) {
            $list[] = $this->mapper->map($model);
        }

        return $list;
    }

}
