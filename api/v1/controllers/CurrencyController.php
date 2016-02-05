<?php

namespace api\v1\controllers;

use Yii;
use api\v1\models\ApiActiveRecord;
use api\v1\extensions\ApiAuthController;
use api\v1\forms\currency\CreateCurrencyForm;
use api\v1\models\Currency;

class CurrencyController extends ApiAuthController
{
    public function actionIndex()
    {
        return [
            'status' => true,
            'data' => Currency::find()->active()->forUsersInSameGroup($this->_user)->all()
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
                'data' => $form->getCurrency()
            ];

        return [
            'status' => false,
            'error' => ApiActiveRecord::ERROR_VALIDATION,
            'error_code' => ApiActiveRecord::ERROR_VALIDATION,
            'data' => $form->errors
        ];
    }
}