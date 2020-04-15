<?php

namespace app\components;

use Yii;
use yii\base\BootstrapInterface;
use yii\base\Event;
use yii\web\Application;
use yii\web\Response;

class Bootstrap implements BootstrapInterface
{
    public function bootstrap($app)
    {
        Event::on(Application::class, Application::EVENT_BEFORE_REQUEST, [$this, 'handleWebRequest']);
        Event::on(Response::class, Response::EVENT_BEFORE_SEND, [$this, 'handleApiResponse']);
    }

    public function handleWebRequest(Event $event)
    {
        $app = Yii::$app;
        if ($app instanceof Application) {
            $request = $app->request;
            $url = $request->getUrl();
            if (strpos($url, '/api/') !== false) {
                $request->enableCsrfValidation = false;
                $request->enableCookieValidation = false;
                $request->enableCsrfCookie = false;

                $app->user->enableSession = false;
                $app->response->format = \yii\web\Response::FORMAT_JSON;
            }
        }
    }

    public function handleApiResponse(Event $event)
    {
        $app = Yii::$app;
        if ($app instanceof Application) {
            $url = Yii::$app->request->getUrl();
            if (strpos($url, '/api/') !== false) {
                $response = $event->sender;
                $noModify = $response->getHeaders()->get('No-Modify', false);
                if (!$noModify) {
                    $response->format = \yii\web\Response::FORMAT_JSON;
                }
                if (strpos($url, '/doc') !== false) {
                    $response->format = \yii\web\Response::FORMAT_HTML;
                }
            }
        }
    }

}
