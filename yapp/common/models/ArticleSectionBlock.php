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
 * @property string $image_title
 * @property string $background_image_title
 * @property string $thumbnail_image_alt
 * @property string $thumbnail_image_title
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
            [['description', 'raw_text', 'image', 'background_image', 'thumbnail_image', 'conclusion','image_title','background_image_title','thumbnail_image_title'], 'string'],
            [['header', 'header_class', 'call2action_description'], 'string', 'max' => 510],
            [['image_alt', 'call2action_name', 'call2action_link', 'call2action_class', 'call2action_comment', 'view', 'color_key', 'structure', 'custom_class', 'code_name', 'description_class', 'raw_text_class', 'image_class', 'conclusion_class','thumbnail_image_alt'], 'string', 'max' => 255],
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

    public function rawTextToItems( $mode = 1)
    {
        $text = $this->raw_text;
//        $arr = explode('<br />' , nl2br(trim($text)) );
        $arr = preg_split('/\r\n|\r|\n/',trim($text));



        if ($mode == 1) {
            $i=0;
            foreach ($arr as $string) {
                $blockItem = new ArticleSectionBlockItem();
                $blockItem->article_section_block_id = $this->id;

                    $blockItem->text = $string;

                $blockItem->save();
                $i++;
            }
            $this->raw_text = null;
            $this->save();
            Yii::$app->session->setFlash('success', 'raw_text конвертирован в '.$i.' пунктов.');
            return true;
        }
        elseif ($mode == 2){
            $res=[];
            $tmp = [];
            $i=0;
            $iter=0;

            foreach ($arr as $string) {
                $i++;
                if (trim($string) == '') {
                    $i=0;
                    $iter ++;
                    $res[]=$tmp;
                    $tmp = [];
                } else {
                    if ($i == 1) {
                        $tmp['head'] = $string;
                        $tmp['text'] = '';
                    } else {
                        if ($i > 2) {
                            $tmp['text'] .= PHP_EOL;
                        }
                        $tmp['text'] .= $string;
                    }
                }
            }
            $res[]=$tmp;
            foreach ($res as $item) {
                $blockItem = new ArticleSectionBlockItem();
                $blockItem->article_section_block_id = $this->id;
                $blockItem->header = $item['head'];
                $blockItem->text = $item['text'];
                $blockItem->save();
            }
            $this->raw_text = null;
            $this->save();
            Yii::$app->session->setFlash('success', 'raw_text конвертирован в '.count($res).' пунктов.');
            return true;
        }

        else {

            return false;
        }

    }
}
