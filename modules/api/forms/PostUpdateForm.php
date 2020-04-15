<?php

namespace app\modules\api\forms;

use app\modules\api\activeRecords\Post;

class PostUpdateForm extends AbstractPostForm
{
    /**
     * @param Post $post
     *
     * @return Post|null
     */
    public function save(Post $post): ?Post
    {
        $post->load($this->getAttributes(), '');
        $post->updatedAt = time();

        /** @var Post|null $saveResult */
        $saveResult = $this->postRepository->save($post);

        return $saveResult;
    }
}
