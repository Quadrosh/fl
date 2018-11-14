<?php

use yii\db\Migration;

/**
 * Handles the creation of table `bank`.
 */
class m181112_170740_create_bank_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('bank', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'full_name' => $this->string(),
            'code' => $this->string(),
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
        $this->dropTable('bank');
    }
}
