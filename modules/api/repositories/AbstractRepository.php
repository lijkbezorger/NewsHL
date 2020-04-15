<?php

namespace app\modules\api\repositories;

use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

abstract class AbstractRepository
{
    /** @var string|ActiveRecord */
    protected $ar;

    public function __construct($activeRecord)
    {
        $this->ar = $activeRecord;
    }

    public function findOne($id)
    {
        return $this->ar::find()
            ->andWhere(['id' => $id])
            ->one();
    }

    public function findAll()
    {
        return $this->ar::find()
            ->all();
    }

    /**
     * @return ActiveRecord
     */
    public function findOneByCondition($condition)
    {
        return $this->ar::find()
            ->andWhere($condition)
            ->one();
    }

    /**
     * @return ActiveRecord[]
     */
    public function findByCondition($condition)
    {
        return $this->ar::find()
            ->andWhere($condition)
            ->all();
    }

    public function getMap($keyField, $valueField, $condition = [], $asArray = true)
    {
        $query = $this->ar::find();
        if ($asArray) {
            $query->select([$keyField, $valueField])->asArray();
        }
        if (!empty($condition)) {
            $query->andWhere($condition);
        }

        return ArrayHelper::map($query->all(), $keyField, $valueField);
    }

    /**
     * @param $model ActiveRecord
     *
     * @param bool $validation
     *
     * @return ActiveRecord|null
     */
    public function save(ActiveRecord $model, bool $validation = false)
    {
        $entity = null;

        $saveResult = $model->save($validation);
        if ($saveResult) {
            $entity = $model;
        }

        return $entity;
    }

    /**
     * @param $model array
     *
     * @param bool $validation
     *
     * @return ActiveRecord|null
     */
    public function saveFromArray(array $model, bool $validation = false)
    {
        $entity = null;

        $instance = new $this->ar();
        $instance->load($model);

        $saveResult = $instance->save($validation);
        if ($saveResult) {
            $entity = $instance;
        }

        return $entity;
    }

    /**
     * @return void
     */
    public function delete($condition)
    {
        $this->ar::deleteAll($condition);
    }

    /**
     * @param ActiveRecord $object
     *
     * @return bool|false|int
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function deleteByObject(ActiveRecord $object)
    {
        return $object->delete();
    }
}
