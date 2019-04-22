<?php

use yii\db\Migration;

/**
 * Handles adding topimage_title to table `article`.
 */
class m190321_081531_add_topimage_title_column_to_article_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('article', 'topimage_title', $this->text());
        $this->addColumn('article', 'background_image_title', $this->text());
        $this->addColumn('article', 'thumbnail_image_alt', $this->string(255));
        $this->addColumn('article', 'thumbnail_image_title', $this->text());
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('article', 'topimage_title');
        $this->dropColumn('article', 'background_image_title');
        $this->dropColumn('article', 'thumbnail_image_alt');
        $this->dropColumn('article', 'thumbnail_image_title');
    }
}
