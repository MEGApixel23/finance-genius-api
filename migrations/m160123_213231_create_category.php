<?php

class m160123_213231_create_category extends \app\extensions\TimestampMigration
{
    private $table = '{{%category}}';

    public function safeUp()
    {
        $this->createTable($this->table, $this->addTimestampData([
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'name' => $this->string()->defaultValue(null),
            'type' => $this->integer(1)->defaultValue(null),
        ]));
        $this->addForeignKey(
            'fk_category_user',
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