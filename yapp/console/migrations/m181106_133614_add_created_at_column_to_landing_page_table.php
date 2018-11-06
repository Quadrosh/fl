<?php

use yii\db\Migration;

/**
 * Handles adding created_at to table `landing_page`.
 */
class m181106_133614_add_created_at_column_to_landing_page_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('landing_page', 'created_at', $this->integer());
        $this->addColumn('landing_page', 'updated_at', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('landing_page', 'created_at');
        $this->dropColumn('landing_page', 'updated_at');
    }
}
