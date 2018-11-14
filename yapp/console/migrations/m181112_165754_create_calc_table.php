<?php

use yii\db\Migration;

/**
 * Handles the creation of table `calc`.
 */
class m181112_165754_create_calc_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('calc', [
            'id' => $this->primaryKey(),
            'bank_id' => $this->integer(),
            'name' => $this->string()->notNull(),
            'description' => $this->text(),
            'status' => $this->string(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),

        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('calc');
    }
}
