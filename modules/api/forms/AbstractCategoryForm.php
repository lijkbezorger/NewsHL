<?php

namespace app\modules\api\forms;

use app\modules\api\repositories\CategoryRepositoryInterface;
use yii\base\Model;

abstract class AbstractCategoryForm extends Model
{
    /** @var string */
    public $name;
    /** @var bool */
    public $isActive = false;

    /** @var CategoryRepositoryInterface */
    protected $categoryRepository;

    /**
     * AbstractCategoryForm constructor.
     *
     * @param CategoryRepositoryInterface $categoryRepository
     */
    public function __construct(
        CategoryRepositoryInterface $categoryRepository
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
