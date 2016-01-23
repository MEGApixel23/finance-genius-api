<?php

use app\extensions\TimestampMigration;

class m160123_210939_create_user_group extends TimestampMigration
{
    private $table = '{{%user_group}}';

    public function safeUp()
    {
        $this->createTable($this->table, $this->addTimestampData([
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'group_id' => $this->integer()->notNull(),
        ]));
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