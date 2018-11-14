<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "calc_factor".
 *
 * @property int $id
 * @property int $calc_id
 * @property string $name
 * @property string $math_sign
 * @property double $value
 * @property string $description
 * @property string $status
 * @property string $fl_code
 * @property string $group
 * @property int $created_at
 * @property int $updated_at
 */
class CalcFactor extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'calc_factor';
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
            [['calc_id', 'name', 'value'], 'required'],
            [['calc_id', 'created_at', 'updated_at'], 'integer'],
            [['value'], 'number'],
            [['description'], 'string'],
            [['name','fl_code','group', 'math_sign', 'status'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'calc_id' => 'Calc ID',
            'name' => 'Name',
            'math_sign' => 'Math Sign',
            'value' => 'Value',
            'description' => 'Description',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
