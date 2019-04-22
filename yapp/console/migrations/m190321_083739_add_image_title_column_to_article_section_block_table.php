<?php

use yii\db\Migration;

/**
 * Handles adding image_title to table `article_section_block`.
 */
class m190321_083739_add_image_title_column_to_article_section_block_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('article_section_block', 'image_title', $this->text());
        $this->addColumn('article_section_block', 'background_image_title', $this->text());
        $this->addColumn('article_section_block', 'thumbnail_image_alt', $this->string(255));
        $this->addColumn('article_section_block', 'thumbnail_image_title', $this->text());

    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('article_section_block', 'image_title');
        $this->dropColumn('article_section_block', 'background_image_title');
        $this->dropColumn('article_section_block', 'thumbnail_image_alt');
        $this->dropColumn('article_section_block', 'thumbnail_image_title');
    }
}
