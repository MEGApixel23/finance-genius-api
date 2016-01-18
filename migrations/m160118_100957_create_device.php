<?php

use yii\db\Migration;

class m160118_100957_create_device extends Migration
{
    private $table = '{{%device}}';

    public function safeUp()
    {
        $this->createTable($this->table, [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'token' => $this->string()->unique(),
            'token_expires_at' => $this->integer(10)->notNull(),

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