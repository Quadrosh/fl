<?php

use yii\db\Migration;

/**
 * Handles the creation of table `article_section`.
 */
class m180828_113929_create_article_section_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('article_section', [
            'id' => $this->primaryKey(),
            'article_id'=> $this->integer()->notNull(),
            'sort' => $this->integer(),
            'code_name'=>$this->string(),
            'header'=>$this->string(510),
            'header_class'=>$this->string(510),
            'description'=>$this->text(),
            'raw_text'=>$this->text(),
            'section_image'=>$this->text(),
            'section_image_alt'=>$this->string(),
            'background_image'=>$this->text(),
            'thumbnail_image'=>$this->text(),
            'call2action_description'=>$this->string(510),
            'call2action_name'=>$this->string(),
            'call2action_link'=>$this->string(),
            'call2action_class'=>$this->string(),
            'call2action_comment'=>$this->string(),
            'view'=>$this->string(),
            'color_key'=>$this->string(),
            'structure'=>$this->string(),
            'custom_class'=>$this->string(),
            'description_class'=>$this->string(),
            'raw_text_class'=>$this->string(),
            'image_class'=>$this->string(),
            'conclusion'=>$this->text(),
            'conclusion_class'=>$this->string(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),

        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('article_section');
    }
}
