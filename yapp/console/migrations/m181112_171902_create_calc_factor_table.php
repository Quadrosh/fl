<?php

use yii\db\Migration;

/**
 * Handles the creation of table `calc_factor`.
 */
class m181112_171902_create_calc_factor_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('calc_factor', [
            'id' => $this->primaryKey(),
            'calc_id' => $this->integer()->notNull(),
            'name' => $this->string()->notNull(),
            'math_sign' => $this->string()->defaultValue('*'),
            'value' => $this->float()->notNull(),
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
        $this->dropTable('calc_factor');
    }
}
