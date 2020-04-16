<?php

namespace unit\activeRecords;

use app\modules\api\activeRecords\Category;

class CategoryTest extends \Codeception\Test\Unit
{
    /** @var \UnitTester $tester */
    protected $tester;

    public function testEmptyValidation()
    {
        $model = $this->make(Category::class, []);
        $this->assertTrue(true, $model->validate());
    }

    public function testValidation()
    {
        $model = $this->make(Category::class, [
            'name' => 'content',
            'isActive' => true,
        ]);
        $this->assertEquals(true, $model->validate());
    }

    public function testWrongValidation()
    {
        $model = $this->make(Category::class, [
            'name' => 1,
            'isActive' => true,
        ]);
        $this->assertEquals(false, $model->validate());
    }

    public function testLongNameValidation()
    {
        $model = $this->make(Category::class, [
            'name' => str_repeat('string', 20),
        ]);
        $this->assertEquals(false, $model->validate());
    }
}
