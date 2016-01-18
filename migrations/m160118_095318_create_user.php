<?php

use yii\db\Migration;

class m160118_095318_create_user extends Migration
{
    private $table = '{{%user}}';

    public function safeUp()
    {
        $this->createTable($this->table, [
            'id' => $this->primaryKey(),
            'email' => $this->string()->unique(),
            'password_hash' => $this->string()->defaultValue(null),
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