<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "preorders".
 *
 * @property int $id
 * @property string $ip
 * @property string $site
 * @property string $service_type
 * @property string $operation_id
 * @property string $platform
 * @property string $inn
 * @property string $name
 * @property string $phone
 * @property string $email
 * @property string $text
 * @property string $from_page
 * @property string $utm_source
 * @property string $utm_medium
 * @property string $utm_campaign
 * @property string $utm_term
 * @property string $utm_content
 * @property string $manager
 * @property string $quality
 * @property string $comment
 * @property int $date
 * @property int $done
 */
class Preorders extends \yii\db\ActiveRecord
{
    public $emailForSend;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'preorders';
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'createdAtAttribute' => 'date',
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
            [['phone'], 'required'],
            [['text', 'utm_source', 'utm_medium', 'utm_campaign', 'utm_term', 'utm_content'], 'string'],
            [['date', 'done'], 'integer'],
            [['ip', 'site', 'service_type', 'platform', 'inn', 'phone', 'email', 'from_page', 'manager', 'quality'], 'string', 'max' => 255],
            [['operation_id', 'name',  'comment'], 'string', 'max' => 510],
            ['utm_source', 'filter', 'filter' => function ($value) {
                if (strlen($value)>=509) {
                    $newValue = substr($value,0,509);
                } else {
                    $newValue = $value;
                }
                return $newValue;
            }],
            ['utm_medium', 'filter', 'filter' => function ($value) {
                if (strlen($value)>=509) {
                    $newValue = substr($value,0,509);
                } else {
                    $newValue = $value;
                }
                return $newValue;
            }],
            ['utm_campaign', 'filter', 'filter' => function ($value) {
                if (strlen($value)>=509) {
                    $newValue = substr($value,0,509);
                } else {
                    $newValue = $value;
                }
                return $newValue;
            }],
            ['utm_term', 'filter', 'filter' => function ($value) {
                if (strlen($value)>=509) {
                    $newValue = substr($value,0,509);
                } else {
                    $newValue = $value;
                }
                return $newValue;
            }],
            ['utm_content', 'filter', 'filter' => function ($value) {
                if (strlen($value)>=509) {
                    $newValue = substr($value,0,509);
                } else {
                    $newValue = $value;
                }
                return $newValue;
            }],
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
            'service_type' => 'Тип услуги',
            'operation_id' => '№ процедуры',
            'platform' => 'Площадка',
            'inn' => 'ИНН',
            'name' => 'Ф.И.О.',
            'phone' => 'Телефон',
            'email' => 'Email',
            'text' => 'Text',
            'from_page' => 'From Page',
            'utm_source' => 'Utm Source',
            'utm_medium' => 'Utm Medium',
            'utm_campaign' => 'Utm Campaign',
            'utm_term' => 'Utm Term',
            'utm_content' => 'Utm Content',
            'manager' => 'Manager',
            'quality' => 'Quality',
            'comment' => 'Comment',
            'date' => 'Date',
            'done' => 'Done',
        ];
    }

    /**
     * Sends an email to the specified email address using the information collected by this model.
     * @param string $email the target email address
     * @return bool whether the email was sent
     */
    public function sendEmail($subject)
    {


        if ( YII_DEBUG == true ) {
            $this->emailForSend =  Yii::$app->params['devOrderEmail'];
        } else {
            $this->emailForSend =  Yii::$app->params['prodOrderEmail'];
        }
        return Yii::$app->mailer->compose()
            ->setTo($this->emailForSend)
            ->setFrom('sender@'.Yii::$app->params['site'])
            ->setSubject($subject)
            ->setHtmlBody(
                "Данные запроса <br>".
                " <br/> Со страницы: ".$this->from_page .
                " <br/> Услуга: ".$this->service_type .
                " <br/> Номер операции: ".$this->operation_id .
                " <br/> Площадка: ".$this->platform .
                " <br/> ИНН: ".$this->inn .
                " <br/> ФИО: ".$this->name .
                " <br/> Телефон: ".$this->phone .
                " <br/> Email: ".$this->email .
                " <br/> Коментарий: <br/>". nl2br($this->text)
            )
            ->send();


    }
}
