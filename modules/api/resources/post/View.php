<?php

namespace app\modules\api\resources\post;

class View
{
    /**
     * @OA\Schema(
     *  schema="Post_view",
     *  @OA\Property(
     *   property="id",
     *   type="integer",
     *   description="Post id"
     *  ),
     *  @OA\Property(
     *   property="content",
     *   type="string",
     *   description="Post content"
     *  ),
     *  @OA\Property(
     *   property="preview",
     *   type="string",
     *   description="Post preview"
     *  ),
     *  @OA\Property(
     *   property="isPublished",
     *   type="boolean",
     *   description="Is post published"
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
     *   ),
     *   @OA\Property(
     *    property="name",
     *    type="string",
     *    description="Category name"
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
            'content',
            'preview',
            'isPublished',
            'publishedAt',
            'category.id',
            'category.name',
        ];
    }
}
