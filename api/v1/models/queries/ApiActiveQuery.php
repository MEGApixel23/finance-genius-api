<?php

namespace api\v1\models\queries;

use yii\db\ActiveQuery;

class ApiActiveQuery extends ActiveQuery
{
    public function active()
    {
        return $this->andWhere(['deleted' => false]);
    }
}