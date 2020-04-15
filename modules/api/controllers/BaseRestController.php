<?php

namespace app\modules\api\controllers;

use Yii;
use yii\rest\Controller;

abstract class BaseRestController extends Controller
{
    protected $request;

    public function __construct($id, $module, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->request = Yii::$app->getRequest();
    }

    protected function setResource($fields)
    {
        $queryParams = $this->request->get();
        $queryParams['fields'] = implode(',', $fields);
        $this->request->setQueryParams($queryParams);
    }

}
