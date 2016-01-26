<?php

namespace api\v1\models\queries;

use api\v1\models\Client;
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

    /**
     * @param $token
     * @return ActiveQuery|null
     */
    public static function findByToken($token)
    {
        $userQuery = null;
        $client = Client::find()->where(['token' => $token])->limit(1)->one();

        if ($client) {
            $userQuery = static::findActive()->andWhere(['id' => $client->user_id]);
        }

        return $userQuery;
    }
}