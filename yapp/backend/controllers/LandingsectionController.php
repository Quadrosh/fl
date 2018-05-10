<?php

namespace backend\controllers;

use common\models\UploadForm;
use Yii;
use common\models\LandingSection;
use yii\data\ActiveDataProvider;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * LandingsectionController implements the CRUD actions for LandingSection model.
 */
class LandingsectionController extends BackController
{


    /**
     * Lists all LandingSection models.
     * @return mixed
     */
    public function actionIndex()
    {
        Url::remember();
        $dataProvider = new ActiveDataProvider([
            'query' => LandingSection::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single LandingSection model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        Url::remember();
        $uploadmodel = new UploadForm();
        return $this->render('view', [
            'model' => $this->findModel($id),
            'uploadmodel' => $uploadmodel,
        ]);
    }

    /**
     * Creates a new LandingSection model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new LandingSection();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(Url::previous());
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing LandingSection model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(Url::previous());
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing LandingSection model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $section = $this->findModel($id);
        $items = $section->listItems;
        $itemIterFind = count($items);
        $itemIterDeleted = 0;
        if ($items) {
            foreach ($items as $item) {
                $item->delete();
                $itemIterDeleted++;
            }
            Yii::$app->session->setFlash('success', 'Найдено '.$itemIterFind.' дочерних объектов'.PHP_EOL.
        'Удалено '.$itemIterDeleted.' дочерних объектов' );
        } else {
            Yii::$app->session->setFlash('success', 'Дочерних объектов не найдено');
        }
        if ($section->delete()) {
            Yii::$app->session->setFlash('success', 'Секция успешно удалена.'.PHP_EOL.
                'Удалено '.$itemIterDeleted.' дочерних объектов');
        } else {
            Yii::$app->session->setFlash('error', 'Секция не удалена');
        }
        return $this->redirect(Url::previous());
    }

    /**
     * Finds the LandingSection model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return LandingSection the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = LandingSection::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    /**
     * Upload images for  model with autofill corresponding model property
     */
    public function actionUpload()
    {
        $uploadmodel = new UploadForm();
        if (Yii::$app->request->isPost) {
            $uploadmodel->imageFile = UploadedFile::getInstance($uploadmodel, 'imageFile');
            $data=Yii::$app->request->post('UploadForm');
            $toModelProperty = $data['toModelProperty'];
            $model = LandingSection::find()->where(['id'=>$data['toModelId']])->one();
            if ($uploadmodel->upload()) {

                $model->$toModelProperty = $uploadmodel->imageFile->baseName . '.' . $uploadmodel->imageFile->extension;
                $model->save();
                Yii::$app->session->setFlash('success', 'Файл загружен успешно');
            } else {
                Yii::$app->session->setFlash('error', 'не получается');
            }
            return $this->redirect(Url::previous());
        }
    }
}
