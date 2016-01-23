<?php

use app\extensions\TimestampMigration;

class m160123_210617_create_group extends TimestampMigration
{
    private $table = '{{%group}}';

    public function safeUp()
    {
        $this->createTable($this->table, $this->addTimestampData([
            'id' => $this->primaryKey(),
            'name' => $this->string()->defaultValue(null),
        ]));
    }

    public function safeDown()
    {
        $this->dropTable($this->table);
    }
}