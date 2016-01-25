<?php

namespace api\v1\controllers;

use api\v1\forms\wallet\CreateWalletForm;
use Yii;
use api\v1\extensions\ApiAuthController;
use api\v1\models\Wallet;
use api\v1\models\queries\WalletActiveQuery;

class WalletController extends ApiAuthController
{
    public function actionIndex()
    {
        $wallets = WalletActiveQuery::findActive()->andWhere([
            'user_id' => $this->_user->id
        ])->all();

        return [
            'status' => true,
            'result' => $wallets
        ];
    }

    public function actionCreate()
    {
        $wallet = new CreateWalletForm();
        $wallet->load(Yii::$app->request->post());
        $wallet->setCreatorUser($this->_user);

        if ($wallet->save())
            return [
                'status' => true,
                'result' => WalletActiveQuery::findActive()->andWhere(['id' => $wallet->id])->limit(1)->one()
            ];

        return [
            'status' => false,
            'errors' => $wallet->errors
        ];
    }

    public function actionUpdate()
    {
        $wallet = WalletActiveQuery::findActive()->andWhere([
            'user_id' => $this->_user->id,
            'id' => (int) Yii::$app->request->get('id')
        ])->limit(1)->one();

        if (!$wallet)
            return [
                'status' => false,
                'error_code' => 'not_found'
            ];

        $wallet->load(Yii::$app->request->post());

        if ($wallet->save())
            return [
                'status' => true,
                'result' => $wallet
            ];

        return [
            'status' => false,
            'errors' => $wallet->errors
        ];
    }
}