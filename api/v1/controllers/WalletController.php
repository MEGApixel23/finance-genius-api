<?php

namespace api\v1\controllers;

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
            ->with('amounts')
            ->asArray()
            ->all();

        return [
            'status' => true,
            'result' => $wallets
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
                'result' => $result
            ];

        return [
            'status' => false,
            'errors' => $form->errors
        ];
    }
}