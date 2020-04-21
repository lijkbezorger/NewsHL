<?php

namespace app\modules\api\repositories;

use app\modules\api\filters\PostFilter;
use yii\caching\Cache;
use yii\caching\TagDependency;
use yii\db\ActiveRecord;

class PostRepositoryCached extends AbstractPostRepository implements PostRepositoryInterface
{
    public const CACHE_TAG_POSTS = 'postList';
    public const CACHE_TAG_POST  = 'post-';

    /** @var PostRepository */
    private $postRepository;
    /** @var Cache */
    private $cache;

    /**
     * PostRepositoryCached constructor.
     *
     * @param PostRepository $postRepository
     */
    public function __construct(
        PostRepository $postRepository
    )
    {
        $this->postRepository = $postRepository;
        $this->cache = \Yii::$app->cache;

        parent::__construct();
    }

    /** @inheritDoc */
    public function findList(PostFilter $filter): array
    {
        try {
            return \Yii::$app->db->cache(
                function () use ($filter) {
                    return $this->postRepository->findList($filter);
                },
                null,
                new TagDependency(['tags' => self::CACHE_TAG_POSTS])
            );
        } catch (\Exception $e) {
            return [];
        }
    }

    /** @inheritDoc */
    public function findFullOneByCondition($condition)
    {
        $id = (isset($condition['id'])) ? $condition['id'] : false;

        return \Yii::$app->db->cache(
            function () use ($condition) {
                return $this->postRepository->findFullOneByCondition($condition);
            },
            null,
            new TagDependency(['tags' => self::CACHE_TAG_POST . $id])
        );
    }

    /** @inheritDoc */
    public function save(ActiveRecord $model, bool $validation = false)
    {
        $entity = $this->postRepository->save($model, $validation);
        TagDependency::invalidate(\Yii::$app->cache, self::CACHE_TAG_POSTS);
        TagDependency::invalidate(\Yii::$app->cache, self::CACHE_TAG_POST . $model->id);
        if ($model->categoryId) {
            TagDependency::invalidate(\Yii::$app->cache, CategoryRepositoryCached::CACHE_TAG_CATEGORY . $model->id);
        }

        return $entity;
    }

    /** @inheritDoc */
    public function deleteByObject(ActiveRecord $model)
    {
        TagDependency::invalidate(\Yii::$app->cache, self::CACHE_TAG_POSTS);
        TagDependency::invalidate(\Yii::$app->cache, self::CACHE_TAG_POST . $model->id);
        if ($model->categoryId) {
            TagDependency::invalidate(\Yii::$app->cache, CategoryRepositoryCached::CACHE_TAG_CATEGORY . $model->id);
        }

        return $this->postRepository->deleteByObject($model);
    }
}
