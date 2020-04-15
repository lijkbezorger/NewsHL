<?php

namespace app\modules\api\controllers;

use app\modules\api\activeRecords\Post;
use app\modules\api\models\Post as PostApi;
use app\modules\api\forms\{PostCreateForm, PostUpdateForm};
use app\modules\api\repositories\PostRepository;
use app\modules\api\resources\post\{Index, View};
use app\modules\api\search\PostSearch;
use yii\db\ActiveRecord;
use yii\web\BadRequestHttpException;
use yii\web\NotFoundHttpException;

/**
 * Class PostController
 * @package app\modules\api\controllers
 */
class PostController extends BaseRestController
{
    /** @var PostRepository */
    private $postRepository;

    /**
     * PostController constructor.
     *
     * @param $id
     * @param $module
     * @param PostRepository $postRepository
     */
    public function __construct(
        $id,
        $module,
        PostRepository $postRepository
    )
    {
        $this->postRepository = $postRepository;
        parent::__construct($id, $module, []);
    }

    /**
     * @OA\Get(
     *  path="/posts",
     *  tags={"Posts"},
     *  summary="Retrieves the collection of posts resources",
     *  @OA\Response(
     *   response = 200,
     *   description = "Post collection response",
     *   @OA\MediaType(
     *    mediaType="application/json",
     *    @OA\Schema(
     *     type="array",
     *     @OA\Items(ref="#/components/schemas/Post_index")
     *    ),
     *   ),
     *  )
     * )
     *
     * @return \yii\data\ActiveDataProvider
     */
    public function actionIndex()
    {
        $searchModel = new PostSearch();
        $dataProvider = $searchModel->search(\Yii::$app->request->get());
        $this->setResource(Index::fields());

        return $dataProvider;
    }

    /**
     * @OA\Get(
     *  path="/post/{id}",
     *  tags={"Posts"},
     *  summary="Retrieves post info",
     *  @OA\Parameter(
     *   name="id",
     *   in="path",
     *   description="Post id",
     *   required=true,
     *   @OA\Schema(type="integer")
     *  ),
     *  @OA\Response(
     *   response = 200,
     *   description = "Post info response",
     *   @OA\MediaType(
     *    mediaType="application/json",
     *    @OA\Schema(ref="#/components/schemas/Post_view")
     *   )
     *  ),
     *  @OA\Response(response=404, description="Post not found")
     * )
     *
     * @param int $id
     *
     * @return Post|ActiveRecord
     * @throws NotFoundHttpException
     */
    public function actionView(int $id)
    {
        $this->setResource(View::fields());

        return $this->findModelById($id);
    }

    /**
     * @OA\Post(
     *  path="/post",
     *  tags={"Posts"},
     *  summary="Create post",
     *  @OA\RequestBody(
     *   required=true,
     *   description="Created post object",
     *   @OA\MediaType(
     *    mediaType="application/json",
     *    @OA\Schema(
     *     @OA\Property(
     *      property="content",
     *      type="string",
     *     ),
     *     @OA\Property(
     *      property="preview",
     *      type="string",
     *     ),
     *     @OA\Property(
     *      property="isPublished",
     *      type="boolean",
     *     ),
     *     @OA\Property(
     *      property="categoryId",
     *      type="integer",
     *      ),
     *     )
     *    )
     *   ),
     *   @OA\Response(
     *    response="200",
     *    description="Post successfully created",
     *    @OA\MediaType(
     *     mediaType="application/json",
     *     @OA\Schema(ref="#/components/schemas/Post_view")
     *    )
     *   ),
     *   @OA\Response(response=400, description="Bad params")
     *  )
     * )
     *
     * @return Post|array|ActiveRecord
     * @throws BadRequestHttpException
     * @throws NotFoundHttpException
     * @throws \yii\base\InvalidConfigException
     */
    public function actionCreate()
    {
        /** @var PostCreateForm $form */
        $form = \Yii::createObject(PostCreateForm::class);
        if ($form->load($this->request->post(), '') && $form->validate()) {
            $postSave = $form->save();
            if ($postSave) {
                return $this->actionView($postSave->id);
            }
        }

        $errors = $form->getErrors();
        if ($errors) {
            \Yii::$app->response->statusCode = 400;

            return ['errors' => $errors];
        }
        throw new BadRequestHttpException('Something went wrong');
    }

    /**
     * @OA\Put(
     *  path="/post/{id}",
     *  tags={"Posts"},
     *  summary="Create post",
     *  @OA\Parameter(
     *   name="id",
     *   in="path",
     *   description="Post id",
     *   required=true,
     *   @OA\Schema(type="integer")
     *  ),
     *  @OA\RequestBody(
     *   required=true,
     *   description="Update post object",
     *   @OA\MediaType(
     *    mediaType="application/json",
     *    @OA\Schema(
     *     @OA\Property(
     *      property="content",
     *      type="string",
     *     ),
     *     @OA\Property(
     *      property="preview",
     *      type="string",
     *     ),
     *     @OA\Property(
     *      property="isPublished",
     *      type="boolean",
     *     ),
     *     @OA\Property(
     *      property="categoryId",
     *      type="integer",
     *     )
     *    )
     *   )
     *   ),
     *   @OA\Response(
     *    response="200",
     *    description="Post successfully updated",
     *    @OA\MediaType(
     *     mediaType="application/json",
     *     @OA\Schema(ref="#/components/schemas/Post_view")
     *    )
     *   ),
     *   @OA\Response(response=400, description="Bad params"),
     *   @OA\Response(response=404, description="Post not found")
     *  )
     * )
     *
     * @param int $id
     *
     * @return Post|array|ActiveRecord
     * @throws NotFoundHttpException
     * @throws \yii\base\InvalidConfigException
     */
    public function actionUpdate(int $id)
    {
        $post = $this->findModelById($id);
        /** @var PostUpdateForm $form */
        $form = \Yii::createObject(PostUpdateForm::class);
        if ($form->load($this->request->post(), '') && $form->validate()) {
            $postSave = $form->save($post);
            if ($postSave) {
                return $this->actionView($postSave->id);
            }
        }

        $errors = $form->getErrors();
        if ($errors) {
            \Yii::$app->response->statusCode = 400;

            return ['errors' => $errors];
        }
    }

    /**
     * @OA\Delete(
     *  path="/post/{id}",
     *   tags={"Posts"},
     *   summary="Delete post by Id",
     *   @OA\Parameter(
     *     name="id",
     *     in="path",
     *     required=true,
     *     description="Id of the post"
     *   ),
     *   @OA\Response(response=204, description="Post successfully deleted"),
     *   @OA\Response(response=400, description="Invalid Id supplied"),
     *   @OA\Response(response=404, description="Post not found")
     * )
     *
     * @param $id
     *
     * @return array|string[]
     * @throws NotFoundHttpException
     */
    public function actionDelete($id)
    {
        $post = $this->findModelById($id);
        $deleteResult = $this->postRepository->deleteByObject($post);

        if ($deleteResult) {
            \Yii::$app->response->statusCode = 204;

            return [];
        } else {
            \Yii::$app->response->statusCode = 400;

            return ['errors' => 'Something went wrong'];
        }
    }

    /**
     * @param $id
     *
     * @return Post|ActiveRecord
     * @throws NotFoundHttpException
     */
    protected function findModelById($id)
    {
        if (($model = $this->postRepository->findOneByCondition(['id' => $id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested post does not exist');
        }
    }
}
