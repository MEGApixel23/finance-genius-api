<?php

use yii\db\Schema;
use yii\db\Migration;

class m160125_091022_alter_token_expires_at_to_client extends Migration
{
    private $table = '{{%client}}';
    private $column = '{{%token_expires_at}}';

    public function safeUp()
    {
        $this->alterColumn($this->table, $this->column, $this->integer(10)->defaultValue(null));
    }

    public function safeDown()
    {
        $this->alterColumn($this->table, $this->column, $this->string());
    }
}