<?php

class m160123_211859_create_currency extends \app\extensions\TimestampMigration
{
    private $table = '{{%currency}}';

    public function safeUp()
    {
        $this->createTable($this->table, $this->addTimestampData([
            'id' => $this->primaryKey(),
            'name' => $this->string()->defaultValue(null),
            'user_id' => $this->integer()->notNull(),
            'sign' => $this->string()->defaultValue(null),
        ]));
        $this->addForeignKey(
            'fk_currency_user',
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