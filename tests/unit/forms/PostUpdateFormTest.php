<?php

namespace unit\forms;

use app\modules\api\activeRecords\Post;
use app\modules\api\forms\PostCreateForm;
use app\modules\api\repositories\PostRepository;

class PostUpdateFormTest extends \Codeception\Test\Unit
{
    /** @var \UnitTester $tester */
    protected $tester;

    public function testSave()
    {
        $post = $this->make(Post::class, [
            'content'     => 'content',
            'preview'     => 'preview',
            'isPublished' => true,
        ]);
        $pr = $this->make(PostRepository::class);
        $model = $this->make(PostCreateForm::class, ['postRepository' => $pr]);
        $this->assertInstanceOf(Post::class, $model->save($post));
    }

    public function testSetUpdatedAt()
    {
        $time = time();
        $post = $this->make(Post::class, [
            'content'     => 'content',
            'preview'     => 'preview',
            'isPublished' => true,
            'updatedAt'   => $time,
        ]);
        $pr = $this->make(PostRepository::class);
        $model = $this->make(PostCreateForm::class, ['postRepository' => $pr]);
        $updatedPost = $model->save($post);
        $this->assertNotEquals($time, $updatedPost);
    }
}
