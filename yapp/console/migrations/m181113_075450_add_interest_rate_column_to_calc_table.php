<?php

use yii\db\Migration;

/**
 * Handles adding interest_rate to table `calc`.
 */
class m181113_075450_add_interest_rate_column_to_calc_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('calc', 'interest_rate', $this->float());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('calc', 'interest_rate');
    }
}
