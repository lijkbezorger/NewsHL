<?php

namespace app\modules\api\forms;

use app\modules\api\repositories\CategoryRepository;
use yii\base\Model;

abstract class AbstractCategoryForm extends Model
{
    /** @var string */
    public $name;
    /** @var bool */
    public $isActive = false;

    /** @var CategoryRepository */
    protected $categoryRepository;

    /**
     * AbstractCategoryForm constructor.
     *
     * @param CategoryRepository $categoryRepository
     */
    public function __construct(
        CategoryRepository $categoryRepository
    )
    {
        $this->categoryRepository = $categoryRepository;

        parent::__construct([]);
    }

    public function rules()
    {
        return [
            [['isActive'], 'boolean'],
            [['name'], 'string', 'max' => 100],
        ];
    }
}
