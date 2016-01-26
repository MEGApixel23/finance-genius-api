<?php

namespace api\v1\models\queries;

use api\v1\models\Client;

class UserActiveQuery extends ApiActiveQuery
{
    public function active()
    {
        return $this->andWhere(['deleted' => false]);
    }

    public function withToken($token)
    {
        $client = Client::find()->where(['token' => $token])->limit(1)->one();

        /* @var $client Client */
        if ($client) {
            $this->andWhere(['id' => $client->user_id]);
        }

        return $this;
    }
}