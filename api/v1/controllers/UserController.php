<?php

namespace api\v1\controllers;

use Yii;
use api\v1\forms\SignUpForm;
use api\v1\extensions\ApiBaseController;
use api\v1\forms\AuthForm;

class UserController extends ApiBaseController
{
    public function actionAuth()
    {
        $form = new AuthForm();
        $form->load(Yii::$app->request->post(), '');

        if ($form->validate() && ($result = $form->auth())) {
            return [
                'status' => true,
                'result' => $result
            ];
        }

        return [
            'status' => false,
            'error' => $form->errors
        ];
    }

    public function actionSignUp()
    {
        $form = new SignUpForm();
        $form->load(Yii::$app->request->post(), '');

        if ($form->validate() && ($result = $form->signUp())) {
            return [
                'status' => true,
                'result' => [
                    'user' => $result['user'],
                    'device' => $result['device'],
                ]
            ];
        }

        return [
            'status' => false,
            'error' => $form->errors
        ];
    }
}