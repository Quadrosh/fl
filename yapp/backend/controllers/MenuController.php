<?php

namespace backend\controllers;

use Yii;
use common\models\Menu;
use common\models\MenuSearch;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * MenuController implements the CRUD actions for Menu model.
 */
class MenuController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Menu models.
     * @return mixed
     */
    public function actionIndex()
    {
        Url::remember();
        $searchModel = new MenuSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Menu model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        Url::remember();
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Menu model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Menu();
        if ($model->load(Yii::$app->request->post())  ) {
            if($model->sub == null) {
                $model->makeRoot();
            } else {
                $parent = Menu::find()->andWhere(['id'=>$model->sub])->one();
                $model->appendTo($parent);
            }
            if ($model->save()) {
                return $this->redirect(Url::previous());
            }
        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Menu model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post())) {
            if($model->sub == null) {
            } else {
                $parent = \common\models\Menu::find()
                    ->andWhere('lft <='.$model->lft)
                    ->andWhere('rgt >='.$model->rgt)
                    ->andWhere(['depth'=>$model->depth-1])
                    ->one();
                if ($model->sub !=$parent->id) {
                    $newParent = Menu::find()->andWhere(['id'=>$model->sub])->one();
                    $model->appendTo($newParent);
                }
            }
            if ($model->save()) {
                return $this->redirect(Url::previous());
            }
        }
        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Menu model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $model->deleteWithChildren();

        return $this->redirect(Url::previous());
    }

    /**
     * Finds the Menu model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Menu the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Menu::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionMove($id, $direction)
    {
        $model = $this->findModel($id);
        $parent = \common\models\Menu::find()
            ->andWhere('lft <='.$model->lft)
            ->andWhere('rgt >='.$model->rgt)
            ->andWhere(['depth'=>$model->depth-1])
            ->one();
        if ($parent) {
            $children = $parent->children(1)->all();
        } else {
            Yii::$app->session->setFlash('error', 'Корневой элемент нельзя двигать');
            return $this->redirect(Url::previous());
        }
        $neighbor = null;

        if ($direction == 'up') {
            foreach ($children as $child) {
                if ($child->lft < $model->lft) {
                    if ($neighbor == null || $child->lft > $neighbor->lft ) {
                        $neighbor = $child;
                    }

                }
            }
            if ($neighbor) {
                $model->insertBefore($neighbor);
            } else {
                Yii::$app->session->setFlash('error', 'Дальше двигать некуда');
            }
        }
        elseif ($direction == 'down') {
            foreach ($children as $child) {
                if ($child->rgt > $model->rgt) {
                    if ($neighbor == null || $child->rgt < $neighbor->rgt ) {
                        $neighbor = $child;
                    }
                }
            }
            if ($neighbor) {
                $model->insertAfter($neighbor);
            } else {
                Yii::$app->session->setFlash('error', 'Дальше двигать некуда');
            }

        }







        return $this->redirect(Url::previous());
    }

}
