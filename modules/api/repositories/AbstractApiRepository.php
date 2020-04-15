<?php

namespace app\modules\api\repositories;

use app\modules\api\activeRecords\ApiModel;
use yii\db\ActiveRecord;

abstract class AbstractApiRepository implements ICategoryApiRepository
{
    /** @var string|ActiveRecord */
    protected $ar;

    public function __construct($activeRecord)
    {
        $this->ar = $activeRecord;
    }
}
