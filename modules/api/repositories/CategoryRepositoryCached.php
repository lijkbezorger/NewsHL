<?php

namespace app\modules\api\repositories;

use app\modules\api\filters\CategoryFilter;
use yii\caching\Cache;
use yii\caching\TagDependency;
use yii\db\ActiveRecord;

class CategoryRepositoryCached extends AbstractCategoryRepository implements CategoryRepositoryInterface
{
    public const CACHE_TAG_CATEGORIES = 'categoryList';
    public const CACHE_TAG_CATEGORY   = 'category-';

    /** @var CategoryRepository */
    private $categoryRepository;
    /** @var Cache */
    private $cache;

    /**
     * CategoryRepositoryCached constructor.
     *
     * @param CategoryRepository $postRepository
     */
    public function __construct(
        CategoryRepository $postRepository
    )
    {
        $this->categoryRepository = $postRepository;
        $this->cache = \Yii::$app->cache;

        parent::__construct();
    }

    /** @inheritDoc */
    public function findList(CategoryFilter $filter): array
    {
        try {
            return \Yii::$app->db->cache(
                function () use ($filter) {
                    return $this->categoryRepository->findList($filter);
                },
                null,
                new TagDependency(['tags' => self::CACHE_TAG_CATEGORIES])
            );
        } catch (\Exception $e) {
            return [];
        }
    }

    /** @inheritDoc */
    public function findOneByCondition($condition)
    {
        $id = (isset($condition['id'])) ? $condition['id'] : false;

        return \Yii::$app->db->cache(
            function () use ($condition) {
                return $this->categoryRepository->findOneByCondition($condition);
            },
            null,
            new TagDependency(['tags' => self::CACHE_TAG_CATEGORY . $id])
        );
    }

    /** @inheritDoc */
    public function save(ActiveRecord $model, bool $validation = false)
    {
        $entity = $this->categoryRepository->save($model, $validation);
        TagDependency::invalidate(\Yii::$app->cache, self::CACHE_TAG_CATEGORIES);
        TagDependency::invalidate(\Yii::$app->cache, self::CACHE_TAG_CATEGORY . $model->id);

        return $entity;
    }

    /** @inheritDoc */
    public function deleteByObject(ActiveRecord $model)
    {
        TagDependency::invalidate(\Yii::$app->cache, self::CACHE_TAG_CATEGORIES);
        TagDependency::invalidate(\Yii::$app->cache, self::CACHE_TAG_CATEGORY . $model->id);

        return $this->categoryRepository->deleteByObject($model);
    }
}
