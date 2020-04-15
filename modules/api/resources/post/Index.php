<?php

namespace app\modules\api\resources\post;

class Index
{
    /**
     * @OA\Schema(
     *  schema="Post_index",
     *  @OA\Property(
     *   property="id",
     *   type="integer",
     *   description="Post id"
     *  ),
     *  @OA\Property(
     *   property="preview",
     *   type="string",
     *   description="Post preview"
     *  ),
     *  @OA\Property(
     *   property="publishedAt",
     *   type="string",
     *   description="Post published at"
     *  ),
     *  @OA\Property(
     *   property="category",
     *   description="Post Category",
     *   type="object",
     *   @OA\Property(
     *    property="id",
     *    type="integer",
     *    description="Category id"
     *   )
     *  )
     * )
     *
     * @return array
     */
    public static function fields(): array
    {
        return [
            'id',
            'preview',
            'publishedAt',
            'category.id',
        ];
    }
}
