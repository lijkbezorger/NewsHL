<?php

namespace app\modules\api\forms;

use app\modules\api\activeRecords\Category;
use app\modules\api\repositories\PostRepository;
use yii\base\Model;

abstract class AbstractPostForm extends Model
{
    /** @var string */
    public $content;
    /** @var string */
    public $preview;
    /** @var bool */
    public $isPublished = false;
    /** @var int */
    public $categoryId;

    /** @var PostRepository */
    protected $postRepository;

    /**
     * AbstractPostForm constructor.
     *
     * @param PostRepository $postRepository
     */
    public function __construct(
        PostRepository $postRepository
    )
    {
        $this->postRepository = $postRepository;

        parent::__construct([]);
    }

    /**
     * @return array|array[]
     */
    public function rules()
    {
        return [
            [['content'], 'string'],
            [['categoryId',], 'integer'],
            [['isPublished'], 'boolean'],
            [['preview'], 'string', 'max' => 255],
            [
                ['categoryId'],
                'exist',
                'skipOnError'     => true,
                'targetClass'     => Category::class,
                'targetAttribute' => ['categoryId' => 'id'],
            ],
        ];
    }
}
