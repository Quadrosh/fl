<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "price".
 *
 * @property integer $id
 * @property integer $from_city_id
 * @property integer $to_city_id
 * @property integer $truck_id
 * @property string $shipment_type
 * @property integer $distance
 * @property integer $price
 * @property integer $created_at
 * @property integer $updated_at
 */
class CalculatorForm extends \yii\base\Model
{

    public $calcId;
    public $timeMonths;
    public $summ;
    public $fz;
    public $commission;
    public $factors;
//    const NOT_FOUND_MESSAGE = 'Позвоните нам и мы быстро рассчитаем цену';
//    const FOUND_MESSAGE = 'Стоимость доставки составит: ';
//    const INFO_MESSAGE = 'Приведенные цены являются приблизительными, для точного расчета оформите заявку.';



    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['timeMonths', 'summ',], 'integer'],
            [['timeMonths', 'summ',], 'required'],
            [['commission' ], 'integer'],
            [['factors'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'timeMonths' => 'Срок гарантии (месяцев)',
            'summ' => 'Сумма гарантии (р.)',
            'commission' => 'Коммиссия банка',


        ];
    }


}
