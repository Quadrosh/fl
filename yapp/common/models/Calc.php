<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "calc".
 *
 * @property int $id
 * @property int $bank_id
 * @property int $fl_code
 * @property string $name
 * @property string $description
 * @property string $status
 * @property float $interest_rate
 * @property int $created_at
 * @property int $updated_at
 */
class Calc extends \yii\db\ActiveRecord
{
    const RESULT_MESSAGE = 'Комиссия банка составит: ';
    const INFO_MESSAGE = 'Приведенные расценки являются приблизительными, для точного расчета оформите заявку.';
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'calc';
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
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['bank_id', 'created_at', 'updated_at'], 'integer'],
            [['name'], 'required'],
            [['interest_rate'], 'double'],
            [['description'], 'string'],
            [['name','fl_code', 'status'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'bank_id' => 'Bank ID',
            'fl_code' => 'FL code',
            'interest_rate' => 'Процентная Ставка',
            'name' => 'Name',
            'description' => 'Description',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function getFactors()
    {
        return $this->hasMany(CalcFactor::class,['calc_id'=>'id']);
    }


    public function calculate($params)
    {

        $summ = $params['summ'];

        $res = $summ * ($this->interest_rate * 0.01) * $params['timeMonths'];


        foreach ($params['factors'] as $key => $value) {
            if ($value) {
                $factor = CalcFactor::find()->where(['id'=>$key])->one();
                $res = $res*$factor->value;
            }
        }
        $fzFactor = CalcFactor::find()->where(['id'=>$params['fz']])->one();
        $res = $res*$fzFactor->value;

        return nl2br(self::RESULT_MESSAGE . PHP_EOL . '<span class="commission">'. round($res,0) .'р.<span>');

    }
}
