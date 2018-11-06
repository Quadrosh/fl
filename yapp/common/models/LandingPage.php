<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "landing_page".
 *
 * @property int $id
 * @property string $name
 * @property string $hrurl
 * @property string $seo_logo
 * @property string $title
 * @property string $description
 * @property string $keywords
 * @property string $view
 * @property string $layout
 * @property string $color
 * @property integer $created_at
 * @property integer $updated_at
 */
class LandingPage extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'landing_page';
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
            [['hrurl'],'unique'],
            [['name', 'hrurl', 'seo_logo', 'title', 'description', 'keywords'], 'required'],
            [['seo_logo', 'description', 'keywords'], 'string'],
            [['created_at', 'updated_at', ], 'integer'],
            [['site','name', 'hrurl', 'title', 'view', 'layout', 'color'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'site' => 'Site',
            'name' => 'Name',
            'hrurl' => 'Hrurl',
            'seo_logo' => 'Seo Logo',
            'title' => 'Title',
            'description' => 'Description',
            'keywords' => 'Keywords',
            'view' => 'View',
            'layout' => 'Layout',
            'color' => 'Color',
        ];
    }

    public function getSections()
    {
        return $this->hasMany(LandingSection::className(), ['page_id'=>'id']);
    }
}
