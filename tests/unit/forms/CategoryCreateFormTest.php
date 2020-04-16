<?php

namespace unit\forms;

use app\modules\api\activeRecords\Category;
use app\modules\api\forms\CategoryCreateForm;
use app\modules\api\repositories\CategoryRepository;

class CategoryCreateFormTest extends \Codeception\Test\Unit
{
    /** @var \UnitTester $tester */
    protected $tester;

    public function testEmptyValidation()
    {
        $model = $this->make(CategoryCreateForm::class, []);
        $this->assertTrue(true, $model->validate());
    }

    public function testValidation()
    {
        $model = $this->make(CategoryCreateForm::class, [
            'name'     => 'name',
            'isActive' => true,
        ]);
        $this->assertEquals(true, $model->validate());
    }

    public function testWrongValidation()
    {
        $model = $this->make(CategoryCreateForm::class, [
            'name'     => 1,
            'isActive' => true,
        ]);
        $this->assertEquals(false, $model->validate());
    }

    public function testSave()
    {
        $cr = $this->make(CategoryRepository::class);
        $model = $this->make(CategoryCreateForm::class, [
            'categoryRepository' => $cr,
            'name'           => 'name',
            'isActive'       => true,
        ]);
        $this->assertInstanceOf(Category::class, $model->save());
    }

    public function testSetTime()
    {
        $cr = $this->make(CategoryRepository::class);
        $model = $this->make(CategoryCreateForm::class, [
            'categoryRepository' => $cr,
            'name'           => str_repeat('name', 20),
            'isActive'       => true,
        ]);
        $post = $model->save();
        $this->assertNotNull($post->createdAt);
        $this->assertNotNull($post->updatedAt);
    }
}
