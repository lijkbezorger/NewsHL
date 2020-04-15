<?php

namespace app\modules\api\repositories;

use app\modules\api\mappers\CategoryMapper;
use app\modules\api\models\Category as CategoryApi;

class CategoryApiRepository extends AbstractApiRepository implements ICategoryApiRepository
{
    /** @var CategoryMapper */
    private $categoryMapper;

    public function __construct(
        CategoryMapper $categoryMapper,
        $activeRecord
    )
    {
        $this->categoryMapper = $categoryMapper;
        parent::__construct($activeRecord);
    }

    /**
     * @return CategoryApi
     */
    public function findOneByCondition(array $condition = []): CategoryApi
    {
        $model = $this->ar::find()
            ->andWhere($condition)
            ->one();

        return $this->categoryMapper->map($model);
    }

}
