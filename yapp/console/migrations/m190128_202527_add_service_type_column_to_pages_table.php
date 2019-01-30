<?php

use yii\db\Migration;

/**
 * Handles adding service_type to table `pages`.
 */
class m190128_202527_add_service_type_column_to_pages_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('pages', 'service_type', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('pages', 'service_type');
    }
}
