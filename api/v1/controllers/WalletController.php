<?php

namespace api\v1\controllers;

use api\v1\forms\wallet\CreateWalletForm;
use Yii;
use api\v1\extensions\ApiAuthController;
use yii\helpers\ArrayHelper;
use api\v1\models\queries\WalletActiveQuery;

class WalletController extends ApiAuthController
{
    public function actionIndex()
    {
        $wallets = WalletActiveQuery::findActive()->andWhere([
            'user_id' => ArrayHelper::getColumn($this->_user->getUsersFromGroup(), 'id')
        ])->with('amounts')->asArray()->all();

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