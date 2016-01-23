<?php

class m160123_211640_create_wallet extends \app\extensions\TimestampMigration
{
    private $table = '{{%wallet}}';

    public function safeUp()
    {
        $this->createTable($this->table, $this->addTimestampData([
            'id' => $this->primaryKey(),
            'name' => $this->string()->defaultValue(null),
            'user_id' => $this->integer()->notNull(),
        ]));
        $this->addForeignKey(
            'fk_wallet_user',
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