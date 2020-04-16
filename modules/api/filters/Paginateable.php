<?php

namespace app\modules\api\filters;

interface Paginateable
{
    /** @return int */
    public function getPageSize(): int;

    /** @return int */
    public function getPage(): int;
}
