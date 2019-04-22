<?php

use yii\db\Migration;

/**
 * Handles adding section_image_title to table `article_section`.
 */
class m190321_082919_add_section_image_title_column_to_article_section_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('article_section', 'section_image_title', $this->text());
        $this->addColumn('article_section', 'background_image_title', $this->text());
        $this->addColumn('article_section', 'thumbnail_image_alt', $this->string(255));
        $this->addColumn('article_section', 'thumbnail_image_title', $this->text());
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('article_section', 'section_image_title');
        $this->dropColumn('article_section', 'background_image_title');
        $this->dropColumn('article_section', 'thumbnail_image_alt');
        $this->dropColumn('article_section', 'thumbnail_image_title');
    }
}
