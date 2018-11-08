<?php

use yii\db\Migration;

/**
 * Handles the creation of table `menu`.
 */
class m180830_123455_create_menu_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('menu', [
            'id' => $this->primaryKey(),
            'tree' => $this->integer()->notNull(),
            'lft' => $this->integer()->notNull(),
            'rgt' => $this->integer()->notNull(),
            'depth' => $this->integer()->notNull(),
            'name' => $this->string(255)->notNull(),
            'icon' => $this->text(),
            'url' => $this->string(255),
            'description' => $this->string(1000),
            'tags' => $this->text(),

        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('menu');
    }
}
