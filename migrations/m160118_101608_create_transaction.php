<?php

use yii\db\Schema;
use yii\db\Migration;

class m160118_101608_create_transaction extends Migration
{
    private $table = '{{%transaction}}';

    public function safeUp()
    {
        $this->createTable($this->table, [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'wallet_id' => $this->integer()->notNull(),
            'category_id' => $this->integer()->notNull(),

            'amount_before' => $this->decimal(15, 4)->defaultValue(0.0),
            'amount_after' => $this->decimal(15, 4)->defaultValue(0.0),
            'amount' => $this->decimal(15, 4)->defaultValue(0.0),
            'comment' => $this->string()->defaultValue(null),
            'type' => $this->integer(1),

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