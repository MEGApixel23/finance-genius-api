<?php

namespace api\v1\controllers;

use api\v1\models\ApiActiveRecord;
use Yii;
use api\v1\models\Wallet;
use api\v1\extensions\ApiAuthController;
use api\v1\forms\wallet\CreateWalletForm;

class WalletController extends ApiAuthController
{
    public function actionIndex()
    {
        $wallets = Wallet::find()
            ->active()
            ->forUsersInSameGroup($this->_user)
            ->expand(Yii::$app->request->getQueryParams())
            ->asArray()
            ->all();

        return [
            'status' => true,
            'data' => $wallets
        ];
    }

    public function actionCreate()
    {
        $form = new CreateWalletForm();
        $form->load(Yii::$app->request->post());
        $form->setUser($this->_user);

        if ($result = $form->save())
            return [
                'status' => true,
                'data' => $result
            ];

        return [
            'status' => false,
            'error' => ApiActiveRecord::ERROR_VALIDATION,
            'error_code' => ApiActiveRecord::ERROR_VALIDATION,
            'data' => $form->errors
        ];
    }
}