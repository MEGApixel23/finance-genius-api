<?php

namespace api\v1\models\queries;

use api\v1\models\Transaction;
use yii\db\ActiveQuery;

class TransactionActiveQuery extends ActiveQuery
{
    public static function findActive()
    {
        return Transaction::find()->andWhere(['deleted' => 0]);
    }
}