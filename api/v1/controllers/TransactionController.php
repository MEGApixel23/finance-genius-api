<?php

namespace api\v1\controllers;

use api\v1\models\queries\TransactionActiveQuery;
use Yii;
use api\v1\extensions\ApiAuthController;
use api\v1\models\Transaction;

class TransactionController extends ApiAuthController
{
    public function actionIndex()
    {
        return [
            'status' => true,
            'result' => TransactionActiveQuery::findActive()->where([
                'user_id' => $this->_user->id
            ])->all()
        ];
    }

    public function actionCreate()
    {
        $transaction = new Transaction();
        $transaction->load(Yii::$app->request->post());
        $transaction->setUser($this->_user);

        if ($transaction->validate() && $transaction->save()) {
            return [
                'status' => true,
                'result' => $transaction
            ];
        }

        return [
            'status' => true,
            'errors' => $transaction->errors
        ];
    }
}