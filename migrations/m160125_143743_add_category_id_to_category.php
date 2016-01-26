<?php

use yii\db\Schema;
use yii\db\Migration;

class m160125_143743_add_category_id_to_category extends Migration
{
    public function safeUp()
    {
        $this->addColumn('category', 'category_id', $this->integer()->defaultValue(null));
    }

    public function safeDown()
    {
        $this->dropColumn('category', 'category_id');
    }
}