<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "article_section_block".
 *
 * @property integer $id
 * @property integer $article_section_id
 * @property string $header
 * @property string $header_class
 * @property string $description
 * @property string $raw_text
 * @property string $image
 * @property string $image_alt
 * @property string $background_image
 * @property string $thumbnail_image
 * @property string $call2action_description
 * @property string $call2action_name
 * @property string $call2action_link
 * @property string $call2action_class
 * @property string $call2action_comment
 * @property string $view
 * @property string $color_key
 * @property string $structure
 * @property integer $accent
 * @property string $custom_class
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $sort
 * @property string $code_name
 * @property string $description_class
 * @property string $raw_text_class
 * @property string $image_class
 * @property string $conclusion
 * @property string $conclusion_class
 */
class ArticleSectionBlock extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'article_section_block';
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
            [['article_section_id'], 'required'],
            [['article_section_id', 'accent', 'sort', 'created_at', 'updated_at'], 'integer'],
            [['description', 'raw_text', 'image', 'background_image', 'thumbnail_image', 'conclusion'], 'string'],
            [['header', 'header_class', 'call2action_description'], 'string', 'max' => 510],
            [['image_alt', 'call2action_name', 'call2action_link', 'call2action_class', 'call2action_comment', 'view', 'color_key', 'structure', 'custom_class', 'code_name', 'description_class', 'raw_text_class', 'image_class', 'conclusion_class'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'article_section_id' => 'Article Section ID',
            'header' => 'Header',
            'header_class' => 'Header Class',
            'description' => 'Description',
            'raw_text' => 'Raw Text',
            'image' => 'Image',
            'image_alt' => 'Image Alt',
            'background_image' => 'Background Image',
            'thumbnail_image' => 'Thumbnail Image',
            'call2action_description' => 'Call2action Description',
            'call2action_name' => 'Call2action Name',
            'call2action_link' => 'Call2action Link',
            'call2action_class' => 'Call2action Class',
            'call2action_comment' => 'Call2action Comment',
            'view' => 'View',
            'color_key' => 'Color Key',
            'structure' => 'Structure',
            'accent' => 'Accent',
            'custom_class' => 'Custom Class',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'sort' => 'Sort',
        ];
    }
    public function getSection()
    {
        return $this->hasOne(ArticleSection::class,['id'=>'article_section_id']);
    }

    public function getItems()
    {
        return $this->hasMany(ArticleSectionBlockItem::class,['article_section_block_id'=>'id'])
            ->orderBy(['sort' => SORT_ASC]);
    }

    public function beforeDelete()
    {
        if (!parent::beforeDelete()) {
            return false;
        }

        if ($this->image) {
            $this->deleteImage('image');
        }
        if ($this->background_image) {
            $this->deleteImage('background_image');
        }
        if ($this->thumbnail_image) {
            $this->deleteImage('thumbnail_image');
        }
        if ($this->items){
            foreach ($this->items as $item) {
                $item->delete();
            }
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
