<?php

use yii\db\Migration;

/**
 * Handles adding image_title to table `article_section_block_item`.
 */
class m190321_084241_add_image_title_column_to_article_section_block_item_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('article_section_block_item', 'image_title', $this->text());
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('article_section_block_item', 'image_title');
    }
}
