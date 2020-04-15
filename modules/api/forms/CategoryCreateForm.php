<?php

namespace app\modules\api\forms;

use app\modules\api\activeRecords\Category;

class CategoryCreateForm extends AbstractCategoryForm
{
    /**
     * @return Category|null
     */
    public function save(): ?Category
    {
        $timestamp = time();

        $category = new Category();
        $category->load($this->getAttributes(), '');
        $category->createdAt = $timestamp;
        $category->updatedAt = $timestamp;

        /** @var Category|null $saveResult */
        $saveResult = $this->categoryRepository->save($category);

        return $saveResult;
    }
}
