<?php

use yii\db\Migration;

/**
 * Handles adding service_type to table `article`.
 */
class m190128_202446_add_service_type_column_to_article_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('article', 'service_type', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('article', 'service_type');
    }
}
