<?php

namespace unit\activeRecords;

use app\modules\api\activeRecords\Post;

class PostTest extends \Codeception\Test\Unit
{
    /** @var \UnitTester $tester */
    protected $tester;

    public function testEmptyValidation()
    {
        $model = $this->make(Post::class, []);
        $this->assertTrue(true, $model->validate());
    }

    public function testValidation()
    {
        $model = $this->make(Post::class, [
            'content'     => 'content',
            'preview'     => 'preview',
            'isPublished' => true,
        ]);
        $this->assertEquals(true, $model->validate());
    }

    public function testWrongValidation()
    {
        $model = $this->make(Post::class, [
            'content'     => 1,
            'preview'     => 'preview',
            'isPublished' => true,
        ]);
        $this->assertEquals(false, $model->validate());
    }
}
