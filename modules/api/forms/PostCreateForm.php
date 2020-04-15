<?php

namespace app\modules\api\forms;

use app\modules\api\activeRecords\Post;

class PostCreateForm extends AbstractPostForm
{
    /**
     * @return Post|null
     */
    public function save(): ?Post
    {
        $timestamp = time();

        $post = new Post();
        $post->load($this->getAttributes(), '');
        if (!$this->preview) {
            $length = strlen($this->content);
            $length = ($length > 255) ? 255 : $length;
            $post->preview = substr($this->content, 0, $length);
        }
        if ($this->isPublished) {
            $post->publishedAt = $timestamp;
        }
        $post->createdAt = $timestamp;
        $post->updatedAt = $timestamp;

        /** @var Post|null $saveResult */
        $saveResult = $this->postRepository->save($post);

        return $saveResult;
    }
}
