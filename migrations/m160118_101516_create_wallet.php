<?php

use yii\db\Schema;
use yii\db\Migration;

class m160118_101516_create_wallet extends Migration
{
    private $table = '{{%wallet}}';

    public function safeUp()
    {
        $this->createTable($this->table, [
            'id' => $this->primaryKey(),
            'name' => $this->string()->defaultValue(null),
            'user_id' => $this->integer()->notNull(),
            'amount' => $this->decimal(15, 4)->defaultValue(0.0),

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
