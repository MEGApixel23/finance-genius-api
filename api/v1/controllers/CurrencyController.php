<?php

namespace api\v1\controllers;

use Yii;
use api\v1\extensions\ApiAuthController;
use api\v1\forms\currency\CreateCurrencyForm;
use api\v1\models\Currency;

class CurrencyController extends ApiAuthController
{
    public function actionIndex()
    {
        return [
            'status' => true,
            'result' => Currency::find()->active()->forUsersInSameGroup($this->_user)->all()
        ];
    }

    public function actionCreate()
    {
        $form = new CreateCurrencyForm();
        $form->load(Yii::$app->request->post());
        $form->setUser($this->_user);

        if ($form->save())
            return [
                'status' => true,
                'result' => $form->getCurrency()
            ];

        return [
            'status' => false,
            'errors' => $form->errors
        ];
    }
}