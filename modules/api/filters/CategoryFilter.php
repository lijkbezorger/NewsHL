<?php

namespace app\modules\api\filters;

use yii\web\Request;

class CategoryFilter implements Paginateable
{
    public const DEFAULT_PAGE_SIZE = 20;

    /** @var int */
    private $pageSize;
    /** @var int */
    private $page;

    /**
     * PostFilter constructor.
     *
     * @param int $pageSize
     * @param int $page
     */
    public function __construct(int $pageSize = self::DEFAULT_PAGE_SIZE, int $page = 1)
    {
        $this->pageSize = ($pageSize < 1) ? self::DEFAULT_PAGE_SIZE : $pageSize;
        $this->page = ($page < 1) ? 1 : $page;
    }

    /** @inheritDoc */
    public function getPageSize(): int
    {
        return $this->pageSize;
    }

    /** @inheritDoc */
    public function getPage(): int
    {
        return $this->page;
    }

    /**
     * @param Request $request
     *
     * @return static
     */
    public static function fromRequest(Request $request): self
    {
        $pageSize = $request->get('pageSize', self::DEFAULT_PAGE_SIZE);
        $page = $request->get('page', 0);

        return new self($pageSize, $page);
    }
}
