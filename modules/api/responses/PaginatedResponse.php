<?php

namespace app\modules\api\responses;

use app\modules\api\filters\Paginateable;

class PaginatedResponse
{
    /** @var array */
    public $items = [];
    /** @var array */
    public $pagination = [];

    /**
     * PaginatedResponse constructor.
     *
     * @param array $data
     * @param Paginateable $paginateable
     */
    public function __construct(array $data, Paginateable $paginateable)
    {
        $this->items = $data;
        $this->pagination = [
            'pageSize' => $paginateable->getPageSize(),
            'page'     => $paginateable->getPage(),
        ];
    }

}
