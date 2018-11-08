<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "article_section_block_item".
 *
 * @property integer $id
 * @property integer $article_section_block_id
 * @property integer $sort
 * @property string $header
 * @property string $header_class
 * @property string $description
 * @property string $text
 * @property string $comment
 * @property string $image
 * @property string $image_alt
 * @property string $link_description
 * @property string $link_name
 * @property string $link_url
 * @property string $link_class
 * @property string $link_comment
 * @property string $view
 * @property string $color_key
 * @property string $structure
 * @property integer $accent
 * @property string $custom_class
 * @property string $type
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $code_name
 * @property integer $description_class
 * @property integer $text_class
 * @property integer $comment_class
 * @property integer $image_class
 */
class ArticleSectionBlockItem extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'article_section_block_item';
    }

    public function behaviors()
    {
        return [
            [
                'class' => \yii\behaviors\TimestampBehavior::class,
            ],
        ];
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['article_section_block_id'], 'required'],
            [['article_section_block_id', 'sort', 'accent', 'created_at', 'updated_at'], 'integer'],
            [['description', 'text', 'comment', 'image'], 'string'],
            [['header', 'header_class', 'link_description'], 'string', 'max' => 510],
            [['image_alt', 'link_name', 'link_url', 'link_class', 'link_comment', 'view', 'color_key', 'structure', 'custom_class', 'type', 'code_name','description_class','text_class','comment_class','image_class'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'article_section_block_id' => 'Article Section Block ID',
            'sort' => 'Sort',
            'header' => 'Header',
            'header_class' => 'Header Class',
            'description' => 'Description',
            'text' => 'Text',
            'comment' => 'Comment',
            'image' => 'Image',
            'image_alt' => 'Image Alt',
            'link_description' => 'Link Description',
            'link_name' => 'Link Name',
            'link_url' => 'Link Url',
            'link_class' => 'Link Class',
            'link_comment' => 'Link Comment',
            'view' => 'View',
            'color_key' => 'Color Key',
            'structure' => 'Structure',
            'accent' => 'Accent',
            'custom_class' => 'Custom Class',
            'type' => 'Type',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
    public function getBlock()
    {
        return $this->hasOne(ArticleSectionBlock::class,['id'=>'article_section_block_id']);
    }

    public function beforeDelete()
    {
        if (!parent::beforeDelete()) {
            return false;
        }

        if ($this->image) {
            $this->deleteImage('image');
        }
        return true;
    }

    public function deleteImage($propertyName)
    {
        $imageFile = Imagefiles::find()->where(['name'=>$this->$propertyName])->one();
        if ($imageFile) {
            $imageFile->deleteWithFile();
        }
        $this->$propertyName = null;
        $this->save();
    }
}
