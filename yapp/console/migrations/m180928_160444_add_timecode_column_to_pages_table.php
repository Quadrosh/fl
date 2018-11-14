<?php

use yii\db\Migration;

/**
 * Handles adding timecode to table `pages`.
 */
class m180928_160444_add_timecode_column_to_pages_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('pages', 'cat_ids', $this->text());
        $this->addColumn('pages', 'status', $this->string());
        $this->addColumn('pages', 'updated_at', $this->integer());
        $this->addColumn('pages', 'created_at', $this->integer());

    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('pages', 'cat_ids');
        $this->dropColumn('pages', 'status');
        $this->dropColumn('pages', 'created_at');
        $this->dropColumn('pages', 'updated_at');
    }
}
