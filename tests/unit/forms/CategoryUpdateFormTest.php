<?php

namespace unit\forms;

use app\modules\api\activeRecords\Category;
use app\modules\api\forms\CategoryCreateForm;
use app\modules\api\repositories\CategoryRepository;

class CategoryUpdateFormTest extends \Codeception\Test\Unit
{
    /** @var \UnitTester $tester */
    protected $tester;

    public function testSave()
    {
        $post = $this->make(Category::class, [
            'name'     => 'name',
            'isActive' => true,
        ]);
        $cr = $this->make(CategoryRepository::class);
        $model = $this->make(CategoryCreateForm::class, ['categoryRepository' => $cr]);
        $this->assertInstanceOf(Category::class, $model->save($post));
    }

    public function testSetUpdatedAt()
    {
        $time = time();
        $post = $this->make(Category::class, [
            'name'      => 'name',
            'isActive'  => true,
            'updatedAt' => $time,
        ]);
        $cr = $this->make(CategoryRepository::class);
        $model = $this->make(CategoryCreateForm::class, ['categoryRepository' => $cr]);
        $updatedCategory = $model->save($post);
        $this->assertNotEquals($time, $updatedCategory);
    }
}
