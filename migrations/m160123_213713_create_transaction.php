<?php

class m160123_213713_create_transaction extends \app\extensions\TimestampMigration
{
    private $table = '{{%transaction}}';

    public function safeUp()
    {
        $this->createTable($this->table, $this->addTimestampData([
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'wallet_id' => $this->integer()->notNull(),
            'currency_id' => $this->integer()->notNull(),
            'category_id' => $this->integer()->notNull(),
            'type' => $this->integer(1)->notNull(),
            'comment' => $this->string()->defaultValue(null),
            'amount' => $this->decimal(14, 4)->notNull()->defaultValue(0.0),
            'amount_before' => $this->decimal(14, 4)->notNull()->defaultValue(0.0),
            'amount_after' => $this->decimal(14, 4)->notNull()->defaultValue(0.0),
            'done_at' => $this->integer(10)->notNull(),
        ]));
        $this->addForeignKey(
            'fk_transaction_category',
            $this->table, 'category_id',
            'category', 'id',
            'CASCADE', 'CASCADE'
        );
        $this->addForeignKey(
            'fk_transaction_user',
            $this->table, 'user_id',
            'user', 'id',
            'CASCADE', 'CASCADE'
        );
        $this->addForeignKey(
            'fk_transaction_wallet',
            $this->table, 'wallet_id',
            'wallet', 'id',
            'CASCADE', 'CASCADE'
        );
    }

    public function safeDown()
    {
        $this->dropTable($this->table);
    }
}