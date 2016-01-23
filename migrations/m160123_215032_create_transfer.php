<?php

class m160123_215032_create_transfer extends \app\extensions\TimestampMigration
{
    private $table = '{{%transfer}}';

    public function safeUp()
    {
        $this->createTable($this->table, $this->addTimestampData([
            'id' => $this->primaryKey(),
            'outcome_transaction_id' => $this->integer()->notNull(),
            'income_transaction_id' => $this->integer()->notNull(),
        ]));
        $this->addForeignKey(
            'fk_transfer_income_transaction',
            $this->table, 'income_transaction_id',
            'transaction', 'id',
            'CASCADE', 'CASCADE'
        );
        $this->addForeignKey(
            'fk_transfer_outcome_transaction',
            $this->table, 'outcome_transaction_id',
            'transaction', 'id',
            'CASCADE', 'CASCADE'
        );
    }

    public function safeDown()
    {
        $this->dropTable($this->table);
    }
}