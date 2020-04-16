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
        $timestamp = time();

        $post->load($this->getAttributes(), '');
        $post->updatedAt = $timestamp;
        if ($this->isPublished && !$post->publishedAt) {
            $post->publishedAt = $timestamp;
        }

        /** @var Post|null $saveResult */
        $saveResult = $this->postRepository->save($post);

        return $saveResult;
    }
}
