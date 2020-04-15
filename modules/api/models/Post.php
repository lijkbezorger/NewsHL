<?php

namespace app\modules\api\models;

class Post
{
    /** @var int */
    public $id;
    /** @var string */
    public $content;
    /** @var string */
    public $preview;
    /** @var bool */
    public $isPublished = false;
    /** @var int */
    public $publishedAt;
    /** @var Category */
    public $category = null;
}
