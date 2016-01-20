<?php

namespace api\v1\models\queries;

use yii\db\ActiveQuery;
use api\v1\models\Device;

class DeviceActiveQuery extends ActiveQuery
{
    public static function findActive()
    {
        return Device::find()->andWhere(['deleted' => 0]);
    }
}