<?php

namespace api\v1\models\queries;

use api\v1\models\Client;

class UserActiveQuery extends ApiActiveQuery
{
    public function withToken($token)
    {
        $client = Client::find()->andWhere(['token' => $token])->limit(1)->one();

        /* @var $client Client */
        $this->andWhere(['id' => isset($client->user_id) ? $client->user_id : 0]);
        return $this;
    }
}