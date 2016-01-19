<?php

namespace api\v1\extensions;

use Yii;
use yii\base\Controller;

class ApiBaseController extends Controller
{
    public function beforeAction($action)
    {
        Yii::$app->response->format = 'json';

        return parent::beforeAction($action);
    }
}