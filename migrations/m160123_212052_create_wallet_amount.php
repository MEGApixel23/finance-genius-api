<?php

class m160123_212052_create_wallet_amount extends \app\extensions\TimestampMigration
{
    private $table = '{{%wallet_amount}}';

    public function safeUp()
    {
        $this->createTable($this->table, $this->addTimestampData([
            'id' => $this->primaryKey(),
            'wallet_id' => $this->integer()->notNull(),
            'currency_id' => $this->integer()->notNull(),
            'amount' => $this->decimal(14, 4)->notNull()->defaultValue(0.0),
            'total_outcome' => $this->decimal(14, 4)->notNull()->defaultValue(0.0),
            'total_income' => $this->decimal(14, 4)->notNull()->defaultValue(0.0),
        ]));
        $this->addForeignKey(
            'fk_wallet_amount_wallet',
            $this->table, 'wallet_id',
            'wallet', 'id',
            'CASCADE', 'CASCADE'
        );
        $this->addForeignKey(
            'fk_wallet_amount_currency',
            $this->table, 'currency_id',
            'currency', 'id',
            'CASCADE', 'CASCADE'
        );
    }

    public function safeDown()
    {
        $this->dropTable($this->table);
    }
}