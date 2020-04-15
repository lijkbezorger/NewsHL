<?php

namespace app\modules\api\controllers;

use genxoft\swagger\JsonAction;
use genxoft\swagger\ViewAction;
use yii\helpers\Url;
use yii\web\Controller;

/**
 * Class DocsController
 * @package app\modules\api\controllers
 * @OA\Server(
 *     url="/api/v1"
 * )
 * @OA\Info(version="1.0", title="NewsHL API v1")
 *
 */
class DocController extends Controller
{
    public function actions()
    {
        return [
            'doc'  => [
                'class'      => ViewAction::class,
                'apiJsonUrl' => Url::to(['/api/v1/json'], true),
            ],
            'json' => [
                'class' => JsonAction::class,
                'dirs'  => [
                    \Yii::getAlias('@app/modules/api/controllers'),
                    \Yii::getAlias('@app/modules/api/resources'),
                ],
            ],
        ];
    }
}
