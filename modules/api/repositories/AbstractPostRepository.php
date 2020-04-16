<?php

namespace app\modules\api\repositories;

use app\modules\api\activeRecords\Post;
use yii\db\ActiveRecord;

class AbstractPostRepository
{
    /** @var string|ActiveRecord */
    protected $ar;

    public function __construct()
    {
        $this->ar = Post::class;
    }
}
