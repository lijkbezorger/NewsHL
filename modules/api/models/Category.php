<?php

namespace app\modules\api\models;

class Category
{
    /** @var int */
    public $id;
    /** @var string */
    public $name;
    /** @var bool */
    public $isActive = false;
    /** @var int */
    public $postsAmount = 0;
}
