<?php

namespace api\v1\controllers;

use Yii;
use api\v1\extensions\ApiBaseController;

class EchoController extends ApiBaseController
{
    public function actionIndex()
    {
        return [
            'status' => true,
            'data' => Yii::$app->request->bodyParams
        ];
    }
}