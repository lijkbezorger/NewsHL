<?php

namespace unit\forms;

use app\modules\api\activeRecords\Post;
use app\modules\api\forms\PostCreateForm;
use app\modules\api\repositories\PostRepository;

class PostCreateFormTest extends \Codeception\Test\Unit
{
    /** @var \UnitTester $tester */
    protected $tester;

    public function testEmptyValidation()
    {
        $model = $this->make(PostCreateForm::class, []);
        $this->assertTrue(true, $model->validate());
    }

    public function testValidation()
    {
        $model = $this->make(PostCreateForm::class, [
            'content'     => 'content',
            'preview'     => 'preview',
            'isPublished' => true,
        ]);
        $this->assertEquals(true, $model->validate());
    }

    public function testWrongValidation()
    {
        $model = $this->make(PostCreateForm::class, [
            'content'     => 1,
            'preview'     => 'preview',
            'isPublished' => true,
        ]);
        $this->assertEquals(false, $model->validate());
    }

    public function testSave()
    {
        $pr = $this->make(PostRepository::class);
        $model = $this->make(PostCreateForm::class, [
            'postRepository' => $pr,
            'content'        => 'content',
            'preview'        => 'preview',
            'isPublished'    => true,
        ]);
        $this->assertInstanceOf(Post::class, $model->save());
    }

    public function testSetTime()
    {
        $pr = $this->make(PostRepository::class);
        $model = $this->make(PostCreateForm::class, [
            'postRepository' => $pr,
            'content'        => str_repeat('content', 20),
            'isPublished'    => true,
        ]);
        $post = $model->save();
        $this->assertNotNull($post->createdAt);
        $this->assertNotNull($post->updatedAt);
    }

    public function testSetPreview()
    {
        $pr = $this->make(PostRepository::class);
        $content = str_repeat('content', 20);
        $model = $this->make(PostCreateForm::class, [
            'postRepository' => $pr,
            'content'        => $content,
            'isPublished'    => true,
        ]);
        $post = $model->save();
        $this->assertEquals(strlen($content), strlen($post->preview));
    }

    public function testSetPublishedAtPreview()
    {
        $pr = $this->make(PostRepository::class);
        $model = $this->make(PostCreateForm::class, [
            'postRepository' => $pr,
            'content'        => str_repeat('content', 20),
            'isPublished'    => true,
        ]);
        $post = $model->save();
        $this->assertNotNull($post->publishedAt);
    }

    public function testNoSetPublishedAtPreview()
    {
        $pr = $this->make(PostRepository::class);
        $model = $this->make(PostCreateForm::class, [
            'postRepository' => $pr,
            'content'        => str_repeat('content', 20),
            'isPublished'    => false,
        ]);
        $post = $model->save();
        $this->assertNull($post->publishedAt);
    }
}
