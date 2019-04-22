<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "article_section".
 *
 * @property integer $id
 * @property integer $article_id
 * @property string $header
 * @property string $header_class
 * @property string $description
 * @property string $raw_text
 * @property string $section_image
 * @property string $section_image_alt
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
 * @property string $custom_class
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $sort
 * @property integer $code_name
 * @property integer $description_class
 * @property integer $raw_text_class
 * @property integer $image_class
 * @property integer $conclusion
 * @property integer $conclusion_class
 * @property integer $section_image_title
 * @property integer $background_image_title
 * @property integer $thumbnail_image_alt
 * @property integer $thumbnail_image_title
 */
class ArticleSection extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'article_section';
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
            [['article_id'], 'required'],
            [['article_id','sort'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['description', 'raw_text', 'section_image', 'background_image', 'thumbnail_image', 'conclusion','section_image_title','background_image_title','thumbnail_image_title'], 'string'],
            [['header', 'header_class', 'call2action_description'], 'string', 'max' => 510],
            [['section_image_alt', 'call2action_name', 'call2action_link', 'call2action_class', 'call2action_comment', 'view', 'color_key', 'structure', 'custom_class', 'code_name','description_class', 'raw_text_class', 'image_class', 'conclusion_class','thumbnail_image_alt'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'article_id' => 'Article ID',
            'header' => 'Header',
            'header_class' => 'Header Class',
            'description' => 'Description',
            'raw_text' => 'Raw Text',
            'section_image' => 'Section Image',
            'section_image_alt' => 'Section Image Alt',
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
            'custom_class' => 'Custom Class',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'sort' => 'Sort',

        ];
    }
    public function getArticle()
    {
        return $this->hasOne(Article::class,['id'=>'article_id']);
    }

    public function getBlocks()
    {
        return $this->hasMany(ArticleSectionBlock::class,['article_section_id'=>'id'])
            ->orderBy(['sort' => SORT_ASC]);
    }

    public function beforeDelete()
    {
        if (!parent::beforeDelete()) {
            return false;
        }

        if ($this->section_image) {
            $this->deleteImage('section_image');
        }
        if ($this->background_image) {
            $this->deleteImage('background_image');
        }
        if ($this->thumbnail_image) {
            $this->deleteImage('thumbnail_image');
        }
        if ($this->blocks){
            foreach ($this->blocks as $item) {
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
