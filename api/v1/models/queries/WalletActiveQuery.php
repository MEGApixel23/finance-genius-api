<?php

namespace api\v1\models\queries;

use api\v1\models\Wallet;
use yii\db\ActiveQuery;

class WalletActiveQuery extends ActiveQuery
{
    public static function findActive()
    {
        return Wallet::find()->andWhere(['deleted' => 0]);
    }
}