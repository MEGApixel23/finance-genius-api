<?php

namespace api\v1\models\queries;

use api\v1\models\User;
use yii\db\ActiveQuery;

class UserActiveQuery extends ActiveQuery
{
    /**
     * @return $this
     */
    public static function findActive()
    {
        return User::find()->andWhere(['deleted' => 0]);
    }
}