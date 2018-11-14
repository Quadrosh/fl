<?php

namespace backend\controllers;


use common\models\Calc;
use common\models\CalculatorForm;
use common\models\UploadForm;
use Yii;
use common\models\Article;
use common\models\ArticleSearch;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * ArticleController implements the CRUD actions for Article model.
 */
class ArticleController extends BackController
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Article models.
     * @return mixed
     */
    public function actionIndex()
    {
        Url::remember();
        $searchModel = new ArticleSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination = ['pageSize' => 100];
        $dataProvider->sort = ['defaultOrder'=> ['id' => SORT_DESC]];

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Article model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        Url::remember();
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Article model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Article();


        if ($model->load(Yii::$app->request->post()) ) {
            $model->cat_ids = json_encode($model->categories);
            if ($model->save()) {
                return $this->redirect(Url::previous());
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);


    }

    /**
     * Updates an existing Article model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->categories = json_decode($model->cat_ids);


        if ($model->load(Yii::$app->request->post()) ) {
            $model->cat_ids = json_encode($model->categories);
            if ($model->save()) {
                return $this->redirect(Url::previous());
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);

//        if ($model->load(Yii::$app->request->post()) && $model->save()) {
//            return $this->redirect(['view', 'id' => $model->id]);
//        } else {
//            return $this->render('update', [
//                'model' => $model,
//            ]);
//        }
    }

    /**
     * Deletes an existing Article model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(Url::previous());
    }

    /**
     * Finds the Article model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Article the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Article::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionHrurl($text, $length, $toLowerCase, $articleId=null)
    {
        $hrurl = $this->actionTranslit($text, $length, $toLowerCase);
        $oldHrurl = Article::find()->where(['hrurl'=>$hrurl])->one();

        if ($oldHrurl) {
            if ($oldHrurl->id!=$articleId) {
                $hrurl = $hrurl.'-'.strtolower(Yii::$app->security->generateRandomString(3));
            }
        }

        return $hrurl;
    }

    public function actionTranslit($text, $length, $toLowerCase)
    {
        $res = Article::cyrillicToLatin($text, $length, $toLowerCase);
        return $res;
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
            $model = Article::find()->where(['id'=>$data['toModelId']])->one();
            $fileName = 'article'.$model->id.$toModelProperty;
            if ($uploadmodel->upload($fileName,true)) {

                $model->$toModelProperty = $fileName . '.' . $uploadmodel->imageFile->extension;
                $model->save();
                Yii::$app->session->setFlash('success', 'Файл загружен успешно');
            } else {
                Yii::$app->session->setFlash('error', 'не получается');
            }
            return $this->redirect(Url::previous());
        }
    }




    public function actionExport($id)
    {
        $article = Article::find()->where(['id'=>$id])->one();

        if ($article->export()) {
            return $this->redirect(Url::previous());
        } else {
            Yii::$app->session->setFlash('error', 'не получается');
        }
    }

    public function actionImport()
    {
        $article = new Article();

        if ($article->import()) {
            Yii::$app->session->setFlash('success', 'ога');
            return $this->redirect(Url::previous());
        } else {
            Yii::$app->session->setFlash('error', 'не получается');
            return $this->redirect(Url::previous());
        }
    }


    public function actionCalculator()
    {
        $params = Yii::$app->request->post('CalculatorForm');
        $calc=Calc::find()->where(['id'=>$params['calcId']])->one();
        return $calc->calculate($params);
    }

}



//            Yii::info([
//            'Yii::$app->request->post(\'PriceCalculator\')'=>Yii::$app->request->post('PriceCalculator'),
//            '$price'=>$price,
//            ], 'back');