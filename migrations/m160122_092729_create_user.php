<?php

use app\extensions\TimestampMigration;

class m160122_092729_create_user extends TimestampMigration
{
    private $table = '{{%user}}';

    public function safeUp()
    {
        $this->createTable($this->table, $this->addTimestampData([
            'id' => $this->primaryKey(),
            'email' => $this->string()->unique(),
            'password_hash' => $this->string()->defaultValue(null),
        ]));
    }

    public function safeDown()
    {
        $this->dropTable($this->table);
    }
}