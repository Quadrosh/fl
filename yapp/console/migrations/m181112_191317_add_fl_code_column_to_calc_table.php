<?php

use yii\db\Migration;

/**
 * Handles adding fl_code to table `calc`.
 */
class m181112_191317_add_fl_code_column_to_calc_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('calc', 'fl_code', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('calc', 'fl_code');
    }
}
