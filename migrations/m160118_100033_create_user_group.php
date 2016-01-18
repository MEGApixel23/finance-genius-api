<?php

use yii\db\Schema;
use yii\db\Migration;

class m160118_100033_create_user_group extends Migration
{
    private $table = '{{%user_group}}';

    public function safeUp()
    {
        $this->createTable($this->table, [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'group_id' => $this->integer()->notNull(),
            'created_at' => $this->integer(10)->defaultValue(null),
            'updated_at' => $this->integer(10)->defaultValue(null),
            'deleted' => $this->boolean()->defaultValue(false),
        ]);
        $this->addForeignKey(
            'fk_user_group_user',
            $this->table, 'user_id',
            'user', 'id',
            'CASCADE', 'CASCADE'
        );
        $this->addForeignKey(
            'fk_user_group_group',
            $this->table, 'group_id',
            'group', 'id',
            'CASCADE', 'CASCADE'
        );
    }

    public function safeDown()
    {
        $this->dropTable($this->table);
    }
}