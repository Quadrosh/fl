<?php

use yii\db\Migration;

/**
 * Handles adding fl_code to table `calc_factor`.
 */
class m181112_200904_add_fl_code_column_to_calc_factor_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('calc_factor', 'fl_code', $this->string());
        $this->addColumn('calc_factor', 'group', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('calc_factor', 'fl_code');
        $this->dropColumn('calc_factor', 'group');
    }
}
