<?php

namespace app\modules\api\resources\category;

class View
{
    /**
     * @OA\Schema(
     *  schema="Category_view",
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
     *   property="isActive",
     *   type="string",
     *   description="Post published at"
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
            'isActive',
            'postsAmount',
        ];
    }
}
