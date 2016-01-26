<?php

namespace api\v1\models\queries;

use api\v1\models\Client;
use yii\db\ActiveQuery;

class ClientActiveQuery extends ActiveQuery
{
    public static function findActive()
    {
        return Client::find()->andWhere(['deleted' => 0]);
    }
}