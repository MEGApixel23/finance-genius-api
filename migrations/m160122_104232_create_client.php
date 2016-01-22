<?php

use app\extensions\TimestampMigration;

class m160122_104232_create_client extends TimestampMigration
{
    private $table = '{{%client}}';

    public function safeUp()
    {
        $this->createTable($this->table, $this->addTimestampData([
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'token' => $this->string()->unique(),
            'token_expires_at' => $this->string(),
        ]));
        $this->addForeignKey(
            'fk_client_user',
            $this->table, 'user_id',
            'user', 'id',
            'CASCADE', 'CASCADE'
        );
    }

    public function safeDown()
    {
        $this->dropTable($this->table);
    }
}