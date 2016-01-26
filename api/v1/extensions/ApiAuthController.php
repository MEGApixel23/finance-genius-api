<?php

namespace api\v1\extensions;

use api\v1\models\User;
use Yii;
use api\v1\models\queries\UserActiveQuery;

/**
 * Class ApiAuthController
 * @package api\v1\extensions
 *
 * @property $_user api\v1\models\User
 */
class ApiAuthController extends ApiBaseController
{
    protected $_user;

    public function beforeAction($action)
    {
        Yii::$app->response->format = 'json';

        $token = call_user_func(function() {
            $headers = Yii::$app->request->headers;
            return isset($headers['token']) ? $headers['token'] : null;
        });

        if (!$token) {
            Yii::$app->response->data = [
                'status' => false,
                'error' => 'NO_TOKEN',
                'error_code' => 'NO_TOKEN'
            ];
            return false;
        }

        $user = User::find()->active()->withToken($token)->one();

        if (!$user) {
            Yii::$app->response->data = [
                'status' => false,
                'error' => 'WRONG_TOKEN',
                'error_code' => 'WRONG_TOKEN'
            ];
            return false;
        }

        $this->_user = $user;

        return parent::beforeAction($action);
    }
}