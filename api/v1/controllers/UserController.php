<?php

namespace api\v1\controllers;

use api\v1\forms\SignUpForm;
use Yii;
use api\v1\extensions\ApiBaseController;
use api\v1\forms\AuthForm;

class UserController extends ApiBaseController
{
    public function actionAuth()
    {
        Yii::$app->response->format = 'json';

        $form = new AuthForm();
        $form->load(Yii::$app->request->post(), '');

        if ($form->validate() && $form->auth()) {
            return [
                'status' => true
            ];
        }

        return [
            'status' => false,
            'error' => $form->errors
        ];
    }

    public function actionSignUp()
    {
        Yii::$app->response->format = 'json';

        $form = new SignUpForm();
        $form->load(Yii::$app->request->post(), '');

        if ($form->validate() && $form->signUp()) {
            return [
                'status' => true
            ];
        }

        return [
            'status' => false,
            'error' => $form->errors
        ];
    }
}