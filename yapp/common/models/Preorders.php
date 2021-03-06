<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\helpers\Json;
use yii\helpers\Url;
use yii\httpclient\Client;

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
    const SPAM_COUNT = 3; // 2
    const SERVICE_TYPE_BG = 'bank_garant';
    const SERVICE_TYPE_TZ = 'tender_zaim';
    const SERVICE_TYPE_MIXED = 'mixed';

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
//            [['ip'], 'string', 'max' => 255],

            ['ip', function ($attribute, $params)
            {
                if(in_array( Yii::$app->request->userIP,Yii::$app->params['blocked_ips'])) {
                    $this->addError($attribute, 'Пожалуйста, свяжитесь с нами по телефону.');
                }
            }],

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

//    public function is8NumbersOnly($attribute)
//    {
//        if (!preg_match('/^[0-9]{8}$/', $this->$attribute)) {
//            $this->addError($attribute, 'must contain exactly 8 digits.');
//        }
//    }

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
            'name' => 'Как к Вам обращаться',
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
     */
    public function sendEmailAndSms($subject)  // SMS ТУТ ЖЕ
    {
        $this->emailForSend =  Yii::$app->params['prodOrderEmail'];
        if ($this->service_type == self::SERVICE_TYPE_TZ) {
            $this->emailForSend =  Yii::$app->params['tzOrderEmail'];
        }
        if ($this->service_type == self::SERVICE_TYPE_BG) {
            $this->emailForSend =  Yii::$app->params['bgOrderEmail'];
        }
        if (  strtolower(YII_ENV) == 'dev' ) {
            $this->emailForSend =  Yii::$app->params['devOrderEmail'];
        }

        $fromPage = $this->from_page?" <br/> Со страницы: ".$this->from_page:null;
        $serviceType = $this->service_type? " <br/> Услуга: ".$this->service_type:null;
        $operationId = $this->operation_id? " <br/> Номер операции: ".$this->operation_id:null;
        $platform = $this->platform? " <br/> Площадка: ".$this->platform:null;
        $inn = $this->inn? " <br/> ИНН: ".$this->inn:null;
        $name = $this->name? " <br/> ФИО: ".$this->name:null;
        $phone = $this->phone?" <br/> Телефон: ".$this->phone:null;
        $email = $this->email? "<br/> Email: ".$this->email:null;
        $comment = $this->comment?" <br/> Коментарий: <br/>". nl2br($this->text):null;

        $emailText =  'Новая заявка с '.$this->site. PHP_EOL.
            $fromPage.
            $serviceType .
            $operationId .
            $platform .
            $inn .
            $name .
            $phone .
            $email.
            $comment;

         $sentEmail = Yii::$app->mailer->compose()
            ->setTo($this->emailForSend)
            ->setFrom('sender@'.Yii::$app->params['site'])
            ->setSubject($subject)
            ->setHtmlBody(
                "Данные запроса <br>".$emailText
            )->send();

        $smsText =  'Новая заявка с '.$this->site. PHP_EOL.
            $fromPage.
            $serviceType .
            $operationId .
            $platform .
            $inn .
            $name .
            $phone .
            $email.
            $comment;

        $smsNotify = $this->notifyBySms($smsText);

        return $smsNotify && $sentEmail ? true : false;

    }



    public static function placeOrder($post,$userIp = null)
    {
        $preorder = new self;
        if ($preorder->load($post)) {
            $spamOrders = self::find()
                ->where(['ip'=>$userIp])
                ->andWhere(['>','date',time()-86400])
                ->all();

            if ( count($spamOrders)  > self::SPAM_COUNT) {
                Yii::$app->session->setFlash('error', 'Вы достигли лимита отправляемых заявок. <br> Свяжитесь с нами по телефону');
                return false;
            }
            $preorder['site'] = Yii::$app->params['site'];
            $preorder['ip'] = Yii::$app->request->userIP;
            if ($preorder->save()) {
                if (Url::base('')!='//finlider.local' &&
                    Url::base('')!='//datender.local' ) {

                    $successful = $preorder->sendEmailAndSms( Yii::$app->params['site'].': Заявка');
                    if ($successful) {
                        Yii::$app->session->setFlash('success',
                            'Ваша заявка отправлена. <br> Мы свяжемся с Вами в ближайшее время.');

                        return true;
                    } else {
                        Yii::$app->session->setFlash('error',
                            'Во время отправки произошла ошибка, попробуйте еще раз.');
                        return false;
                    }

                } else {
                    Yii::$app->session->setFlash('success',
                        'локальный хост - заявка сохранена');
                }

            } else {
                Yii::$app->session->setFlash('error',
                    'Ошибка сохранения заявки. Оформите заявку по телефону.');
                return false;
            }
        } else {
            Yii::$app->session->setFlash('error',
                'Во время отправки произошла ошибка, попробуйте еще раз. Или отправьте заявку в свободной форме на zakaz@'.Yii::$app->params['site'].' или оформите заявку по телефону');
            return false;
        }

    }


    public function notifyBySms($text)
    {
            $client = new Client();
            $response = $client->createRequest()
                ->setMethod('post')
                ->setUrl('https://sms.ru/sms/send')
                ->setData([
                    'api_id' => Yii::$app->params['smsApiId'],
                    'to' =>  Yii::$app->params['smsOrderPhone'],
                    'text'=> $text
                ])
                ->send();
            return $response->isOk ? true : false;
    }
}
