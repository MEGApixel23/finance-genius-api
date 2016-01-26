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
        $form->load(Yii::$app->request->post());

        if ($data = $form->auth()) {
            return [
                'status' => true,
                'data' => $data
            ];
        }

        return [
            'status' => false,
            'error' => 'VALIDATION_ERROR',
            'error_code' => 'VALIDATION_ERROR',
            'data' => $form->errors
        ];
    }

    /**
     * @return array
     */
    public function actionSignUp()
    {
        $form = new SignUpForm();
        $form->load(Yii::$app->request->post());

        if ($data = $form->signUp()) {
            return [
                'status' => true,
                'data' => $data
            ];
        }

        return [
            'status' => false,
            'error' => 'VALIDATION_ERROR',
            'error_code' => 'VALIDATION_ERROR',
            'data' => $form->errors
        ];
    }
}