<?php

use yii\db\Migration;

/**
 * Handles the creation of table `article_section_block_item`.
 */
class m180828_124851_create_article_section_block_item_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('article_section_block_item', [
            'id' => $this->primaryKey(),
            'article_section_block_id'=> $this->integer()->notNull(),
            'sort' => $this->integer(),
            'code_name' => $this->string(),
            'header'=>$this->string(510),
            'header_class'=>$this->string(510),
            'description'=>$this->text(),
            'text'=>$this->text(),
            'comment'=>$this->text(),
            'image'=>$this->text(),
            'image_alt'=>$this->string(),
            'link_description'=>$this->string(510),
            'link_name'=>$this->string(),
            'link_url'=>$this->string(),
            'link_class'=>$this->string(),
            'link_comment'=>$this->string(),
            'view'=>$this->string(),
            'color_key'=>$this->string(),
            'structure'=>$this->string(),
            'accent'=>$this->boolean(),
            'custom_class'=>$this->string(),
            'type'=>$this->string(),
            'description_class'=>$this->string(),
            'text_class'=>$this->string(),
            'comment_class'=>$this->string(),
            'image_class'=>$this->string(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('article_section_block_item');
    }
}
