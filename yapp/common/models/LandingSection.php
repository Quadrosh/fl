<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "landing_section".
 *
 * @property int $id
 * @property int $page_id
 * @property int $order_num
 * @property string $head
 * @property string $lead
 * @property string $text
 * @property string $extra
 * @property string $stylekey
 * @property string $image
 * @property string $image_alt
 * @property string $call2action_name
 * @property string $section_type
 */
class LandingSection extends \yii\db\ActiveRecord
{
    public $sectionListItems;
//    public $list_items=[];

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'landing_section';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['page_id'], 'required'],
            [['page_id', 'order_num'], 'integer'],
            [['lead', 'text', 'extra'], 'string'],
            [['head', 'stylekey', 'image', 'image_alt', 'call2action_name', 'section_type'], 'string', 'max' => 255],
//            [['list_items'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'page_id' => 'Page ID',
            'order_num' => 'Order Num',
            'head' => 'Head',
            'lead' => 'Lead',
            'text' => 'Text',
            'extra' => 'Extra',
            'stylekey' => 'Stylekey',
            'image' => 'Image',
            'image_alt' => 'Image Alt',
            'call2action_name' => 'Call2action Name',
            'section_type' => 'Section Type',
        ];
    }


    /**
     * Безопасные поля
     *
     * @return array
     */
    public function fields()
    {
        return [
            'id',
            'page_id',
            'order_num',
            'head',
            'lead',
            'text',
            'extra',
            'stylekey',
            'image',
            'image_alt',
            'call2action_name',
            'section_type',
            'sectionListItems',

            'list_items' => function ($q) {
                return $q->listItems;
//                return count($q->listItems);
            }
        ];
    }


    public function getListItems()
    {
        return $this->hasMany(LandingListitem::className(),['section_id'=>'id'])->orderBy('order_num');
    }

    /**
     * Landing Page
     */
    public function getLandingPage()
    {
        return $this->hasOne(LandingPage::className(),['id'=>'page_id']);
    }

}
