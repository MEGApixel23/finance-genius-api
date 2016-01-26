<?php

namespace app\extensions;

use yii\db\Migration;

class TimestampMigration extends Migration
{
    public function addTimestampData($array)
    {
        return array_merge($array, [
            'created_at' => $this->integer(10),
            'updated_at' => $this->integer(10),
            'deleted' => $this->boolean()->defaultValue(false),
        ]);
    }
}