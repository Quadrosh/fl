<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "visit".
 *
 * @property int $id
 * @property string $ip
 * @property string $city
 * @property string $url
 * @property string $utm_source
 * @property string $utm_medium
 * @property string $utm_campaign
 * @property string $utm_term
 * @property string $utm_content
 * @property string $comment
 * @property int $created_at
 */
class Visit extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'visit';
    }

    public function behaviors()
    {
        return [
            'timestamp'  => [
                'class' => TimestampBehavior::className(),
                'updatedAtAttribute' => false,
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created_at','qnt'], 'integer'],
            [['ip'], 'string', 'max' => 100],
            [['city', 'url', 'comment', 'lp_hrurl', 'site'], 'string', 'max' => 255],
            [['utm_source', 'utm_medium', 'utm_campaign', 'utm_term', 'utm_content'], 'string', 'max' => 510],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ip' => 'Ip',
            'site' => 'Site',
            'city' => 'City',
            'url' => 'Url',
            'qnt' => 'Qnt',
            'utm_source' => 'Utm Source',
            'utm_medium' => 'Utm Medium',
            'utm_campaign' => 'Utm Campaign',
            'utm_term' => 'Utm Term',
            'utm_content' => 'Utm Content',
            'comment' => 'Comment',
            'created_at' => 'Created At',
        ];
    }
}
