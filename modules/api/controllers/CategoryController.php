<?php

namespace app\modules\api\controllers;

use app\modules\api\activeRecords\Category;
use app\modules\api\forms\CategoryCreateForm;
use app\modules\api\forms\CategoryUpdateForm;
use app\modules\api\models\Category as CategoryApi;
use app\modules\api\repositories\CategoryRepository;
use app\modules\api\repositories\ICategoryApiRepository;
use app\modules\api\resources\category\Index;
use app\modules\api\resources\category\View;
use app\modules\api\search\CategorySearch;
use yii\db\ActiveRecord;
use yii\web\BadRequestHttpException;
use yii\web\NotFoundHttpException;

class CategoryController extends BaseRestController
{
    /** @var ICategoryApiRepository */
    private $categoryApiRepository;
    /** @var CategoryRepository */
    private $categoryRepository;

    /**
     * PostController constructor.
     *
     * @param $id
     * @param $module
     * @param ICategoryApiRepository $categoryApiRepository
     * @param CategoryRepository $categoryRepository
     */
    public function __construct(
        $id,
        $module,
        ICategoryApiRepository $categoryApiRepository,
        CategoryRepository $categoryRepository
    )
    {
        $this->categoryApiRepository = $categoryApiRepository;
        $this->categoryRepository = $categoryRepository;
        parent::__construct($id, $module, []);
    }

    /**
     * @OA\Get(
     *  path="/categories",
     *  tags={"Categories"},
     *  summary="Retrieves the collection of categories resources",
     *  @OA\Response(
     *   response = 200,
     *   description = "Category collection response",
     *   @OA\MediaType(
     *    mediaType="application/json",
     *    @OA\Schema(
     *     type="array",
     *     @OA\Items(ref="#/components/schemas/Category_index")
     *    ),
     *   ),
     *  )
     * )
     *
     * @return \yii\data\ActiveDataProvider
     */
    public function actionIndex()
    {
        $searchModel = \Yii::createObject(CategorySearch::class);
        $dataProvider = $searchModel->search(\Yii::$app->request->get());
        $this->setResource(Index::fields());

        return $dataProvider;
    }

    /**
     * @OA\Get(
     *  path="/category/{id}",
     *  tags={"Categories"},
     *  summary="Retrieves category info",
     *  @OA\Parameter(
     *   name="id",
     *   in="path",
     *   description="Category id",
     *   required=true,
     *   @OA\Schema(type="integer")
     *  ),
     *  @OA\Response(
     *   response = 200,
     *   description = "Category info response",
     *   @OA\MediaType(
     *    mediaType="application/json",
     *    @OA\Schema(ref="#/components/schemas/Category_view")
     *   )
     *  ),
     *  @OA\Response(response=404, description="Category not found")
     * )
     *
     * @param int $id
     *
     * @return CategoryApi
     * @throws NotFoundHttpException
     */
    public function actionView(int $id)
    {
        $this->setResource(View::fields());

        return $this->findModelApiById($id);
    }

    /**
     * @OA\Post(
     *  path="/category",
     *  tags={"Categories"},
     *  summary="Create category",
     *  @OA\RequestBody(
     *   required=true,
     *   description="Created category object",
     *   @OA\MediaType(
     *    mediaType="application/json",
     *    @OA\Schema(
     *     @OA\Property(
     *      property="name",
     *      type="string",
     *     ),
     *     @OA\Property(
     *      property="isActive",
     *      type="boolean",
     *     )
     *    )
     *   )
     *  ),
     *  @OA\Response(
     *   response="200",
     *   description="Category successfully created",
     *   @OA\MediaType(
     *    mediaType="application/json",
     *    @OA\Schema(ref="#/components/schemas/Category_view")
     *   )
     *  ),
     *  @OA\Response(response=400, description="Bad params")
     *  )
     * )
     *
     * @return Category|array|ActiveRecord
     * @throws BadRequestHttpException
     * @throws NotFoundHttpException
     * @throws \yii\base\InvalidConfigException
     */
    public function actionCreate()
    {
        /** @var CategoryCreateForm $form */
        $form = \Yii::createObject(CategoryCreateForm::class);
        if ($form->load($this->request->post(), '') && $form->validate()) {
            $categorySave = $form->save();
            if ($categorySave) {
                return $this->actionView($categorySave->id);
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
     *  path="/category/{id}",
     *  tags={"Categories"},
     *  summary="Create category",
     *  @OA\Parameter(
     *   name="id",
     *   in="path",
     *   description="Category id",
     *   required=true,
     *   @OA\Schema(type="integer")
     *  ),
     *  @OA\RequestBody(
     *   required=true,
     *   description="Created category object",
     *   @OA\MediaType(
     *    mediaType="application/json",
     *    @OA\Schema(
     *     @OA\Property(
     *      property="name",
     *      type="string",
     *     ),
     *     @OA\Property(
     *      property="isActive",
     *      type="boolean",
     *     )
     *    )
     *   )
     *  ),
     *  @OA\Response(
     *   response="200",
     *   description="Category successfully updated",
     *   @OA\MediaType(
     *    mediaType="application/json",
     *    @OA\Schema(ref="#/components/schemas/Category_view")
     *   )
     *  ),
     *  @OA\Response(response=400, description="Bad params")
     *  )
     * )
     *
     * @param int $id
     *
     * @return Category|ActiveRecord
     * @throws BadRequestHttpException
     * @throws NotFoundHttpException
     * @throws \yii\base\InvalidConfigException
     */
    public function actionUpdate(int $id)
    {
        $category = $this->findModelById($id);
        /** @var CategoryUpdateForm $form */
        $form = \Yii::createObject(CategoryUpdateForm::class);
        if ($form->load($this->request->post(), '') && $form->validate()) {
            $categorySave = $form->save($category);
            if ($categorySave) {
                return $this->actionView($categorySave->id);
            }
        }

        $errors = $form->getErrors();
        if ($errors) {
            throw new BadRequestHttpException('errors');
        }
    }

    /**
     * @OA\Delete(
     *  path="/category/{id}",
     *   tags={"Categories"},
     *   summary="Delete category by Id",
     *   @OA\Parameter(
     *     name="id",
     *     in="path",
     *     required=true,
     *     description="Id of the category"
     *   ),
     *   @OA\Response(response=204, description="Category successfully deleted"),
     *   @OA\Response(response=400, description="Invalid Id supplied"),
     *   @OA\Response(response=404, description="Category not found")
     * )
     *
     * @param $id
     *
     * @return array|string[]
     * @throws NotFoundHttpException
     */
    public function actionDelete($id)
    {
        $category = $this->findModelById($id);
        $deleteResult = $this->categoryRepository->deleteByObject($category);

        if ($deleteResult) {
            \Yii::$app->response->statusCode = 204;

            return [];
        } else {
            return ['errors' => 'Something went wrong'];
        }
    }

    /**
     * @param $id
     *
     * @return CategoryApi
     * @throws NotFoundHttpException
     */
    protected function findModelApiById($id)
    {
        if (($model = $this->categoryApiRepository->findOneByCondition(['id' => $id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested post does not exist');
        }
    }

    /**
     * @param $id
     *
     * @return Category|ActiveRecord
     * @throws NotFoundHttpException
     */
    protected function findModelById($id)
    {
        if (($model = $this->categoryRepository->findOneByCondition(['id' => $id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested post does not exist');
        }
    }
}
