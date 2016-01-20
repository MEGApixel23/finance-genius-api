<?php

namespace api\v1\models\queries;

use yii\db\ActiveQuery;
use api\v1\models\Category;

class CategoryActiveQuery extends ActiveQuery
{
    public static function findActive()
    {
        return Category::find()->andWhere(['deleted' => 0]);
    }
}