<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "imagefiles".
 *
 * @property int $id
 * @property string $name
 */
class Imagefiles extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'imagefiles';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 524],
            [['name'], 'unique',  'message' => 'Файл "{value}" уже существует, измени имя загружаемого файла или назначь существующий'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
        ];
    }


    public function addNew($name,$replace=null)
    {
        if ($replace) {
            if (Imagefiles::find()->where(['name'=>$name])->one()) {
                return true;
            }
        }
        $this->name = $name;
        if ($this->validate()) {
            if ($this->save()) {
                return true;
            } else {
                Yii::$app->session->setFlash('error', 'Ошибка сохранения imagefile');
                return false;
            }
        } else {
            Yii::$app->session->setFlash('error', 'Ошибка валидации - '.$this->errors['name'][0]);
            return false;
        }
    }
    public function deleteWithFile()
    {
        $fullPath = Yii::$app->basePath.'/web/img/'.$this->name;
        if (file_exists($fullPath)) {
            if(!unlink($fullPath)) {
                Yii::$app->session->setFlash('error', 'неполучается удалить файл');
            }
        } else {
            Yii::$app->session->setFlash('error', 'файл не найден');
        }
        $this->delete();
    }
}
