<?php

namespace api\v1\models\queries;

use api\v1\models\Client;
use api\v1\models\Currency;
use yii\db\ActiveQuery;

class CurrencyActiveQuery extends ActiveQuery
{
    public static function findActive()
    {
        return Currency::find()->andWhere(['deleted' => 0]);
    }
}