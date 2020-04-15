<?php

namespace app\modules\api\forms;

use app\modules\api\activeRecords\Category;

class CategoryUpdateForm extends AbstractCategoryForm
{
    /**
     * @param Category $post
     *
     * @return Category|null
     */
    public function save(Category $category): ?Category
    {
        $category->load($this->getAttributes(), '');
        $category->updatedAt = time();

        /** @var Category|null $saveResult */
        $saveResult = $this->categoryRepository->save($category);

        return $saveResult;
    }
}
