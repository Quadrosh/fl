<?php

use yii\db\Migration;

/**
 * Handles the creation of table `article`.
 */
class m180828_112646_create_article_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('article', [
            'id' => $this->primaryKey(),
            'site' => $this->string(),
            'list_name' => $this->string(255)->notNull(),
            'cat_ids'=>$this->text(),
            'hrurl' => $this->string(255),
            'title'=>$this->string(255),
            'description'=>$this->text(),
            'keywords'=>$this->text(),
            'exerpt'=>$this->text(),
            'exerpt_big'=>$this->text(),
            'h1'=>$this->string(255),
            'raw_text'=>$this->text(),
            'topimage'=>$this->string(255),
            'topimage_alt'=>$this->string(255),
            'background_image'=>$this->text(),
            'thumbnail_image'=>$this->text(),
            'call2action_description'=>$this->string(510),
            'call2action_name'=>$this->string(),
            'call2action_link'=>$this->string(),
            'call2action_class'=>$this->string(),
            'call2action_comment'=>$this->string(),
            'imagelink'=>$this->string(255),
            'imagelink_alt'=>$this->string(255),
            'author'=>$this->string(255),
            'status'=>$this->string(255),
            'view'=>$this->string(255),
            'layout'=>$this->string(255),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),

        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('article');
    }
}
