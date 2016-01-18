<?php

use yii\db\Migration;

class m160118_095721_create_group extends Migration
{
    private $table = '{{%group}}';

    public function safeUp()
    {
        $this->createTable($this->table, [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'created_at' => $this->integer(10)->defaultValue(null),
            'updated_at' => $this->integer(10)->defaultValue(null),
            'deleted' => $this->boolean()->defaultValue(false),
        ]);
    }

    public function safeDown()
    {
        $this->dropTable($this->table);
    }
}