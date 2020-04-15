<?php

namespace app\modules\api\resources\category;

class Index
{
    /**
     * @OA\Schema(
     *  schema="Category_index",
     *  @OA\Property(
     *   property="id",
     *   type="integer",
     *   description="Category id"
     *  ),
     *  @OA\Property(
     *   property="name",
     *   type="string",
     *   description="Category name"
     *  ),
     *  @OA\Property(
     *   property="postsAmount",
     *   type="integer",
     *   description="Posts amount"
     *  )
     * )
     */
    public static function fields()
    {
        return [
            'id',
            'name',
            'postsAmount',
        ];
    }
}
