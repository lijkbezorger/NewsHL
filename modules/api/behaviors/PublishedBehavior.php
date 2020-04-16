<?php

namespace app\modules\general\behaviors;

use yii\behaviors\AttributeBehavior;
use yii\db\ActiveRecord;

/**
 * Class PublishedBehavior
 * @package app\modules\general\behaviors
 */
class PublishedBehavior extends AttributeBehavior
{
    /** @var string */
    public $flag;
    /** @var string */
    public $attribute;

    /**
     * @return array|string[]
     */
    public function events()
    {
        return [
            ActiveRecord::EVENT_BEFORE_INSERT => 'checkIsPublished',
        ];
    }

    public function checkIsPublished(): void
    {
        $model = $this->owner;
        if ($model->{$this->flag} && !$model->{$this->attribute}) {
            $model->{$this->attribute} = time();
        }
    }
}
