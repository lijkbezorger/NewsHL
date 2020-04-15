<?php

namespace app\modules\api\repositories;

use app\modules\api\models\Category;

interface ICategoryApiRepository
{
    public function findOneByCondition(array $condition = []): Category;
}
