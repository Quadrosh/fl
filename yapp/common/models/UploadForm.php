<?php

namespace common\models;

use backend\controllers\ImagefilesController;
use yii\base\Action;
use yii\base\Model;
use yii\web\UploadedFile;
use Yii;
use common\models\Imagefiles;

class UploadForm  extends Model
{
    /**
     * @var UploadedFile
     */
    public $imageFile;
    public $jsonFile;
    public $toModelId;
    public $toModelProperty;

    public function rules()
    {
        return [
            [['imageFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, svg'],
            [['jsonFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'json'],

        ];
    }

    public function upload()
    {
        $imageListItem = new Imagefiles();
        $fileName = $this->imageFile->baseName .'.' . $this->imageFile->extension;
        if ($this->validate() && $imageListItem->addNew($fileName)) {
            if ($this->imageFile->saveAs('img/' . $fileName)) {
                return true;
            } else {
                return false;
            }
        }
    }

    public function change($filename)
    {
        if ($this->validate()) {
            if ($this->imageFile->saveAs(Yii::$app->basePath . '/web/img/' . $filename)) {
                return true;
            } else {
                return false;
            }
        }
    }





}