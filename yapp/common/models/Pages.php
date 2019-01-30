<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "pages".
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property string $keywords
 * @property string $pagehead
 * @property string $pagedescription
 * @property string $text
 * @property string $imagelink
 * @property string $imagelink_alt
 * @property string $sendtopage
 * @property string $promolink
 * @property string $promoname
 * @property string $cat_ids
 * @property string $status
 * @property string $service_type
 * @property string $created_at
 * @property string $updated_at
 */
class Pages extends \yii\db\ActiveRecord
{
    public $categories;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pages';
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
            [['title', 'description','hrurl' ], 'required'],
//            [['hrurl'],'unique'],
            [['cat_ids','description', 'seo_logo','keywords', 'pagedescription', 'text'], 'string'],
            [[
                'site',
                'title',
                'pagehead',
                'imagelink',
                'hrurl',
                'imagelink_alt',
                'sendtopage',
                'promolink',
                'promoname',
                'layout',
                'view',
                'status',
                'service_type'
            ], 'string', 'max' => 255],
            [['created_at', 'updated_at'], 'integer'],
            [['categories'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'site' => 'Site',
            'id' => 'ID',
            'seo_logo' => 'SEO logo (title для копирования Title)',
            'hrurl' => 'hrurl',
            'title' => 'Title',
            'description' => 'meta Description',
            'keywords' => 'meta Keywords',
            'pagehead' => 'Pagehead H1',
            'pagedescription' => 'Pagedescription',
            'text' => 'Text',
            'imagelink' => 'Imagelink',
            'imagelink_alt' => 'Imagelink Alt',
            'sendtopage' => 'Sendtopage',
            'promolink' => 'Promolink',
            'promoname' => 'Promoname',
            'layout' => 'Custom Layout',
            'view' => 'Custom View',
        ];
    }
}
