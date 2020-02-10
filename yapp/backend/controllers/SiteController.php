<?php
namespace backend\controllers;

use common\models\Preorders;
use Yii;
use yii\data\ActiveDataProvider;
use yii\helpers\Url;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;

/**
 * Site controller
 */
class SiteController extends Controller
{

    public $layout = 'login';

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        Url::remember();
        if (Yii::$app->user->can('adminPermission', [])) {
            $this->layout = 'main';
        }
        elseif (Yii::$app->user->can('statPermission', [])) {
            $this->layout = 'stat';
        }

        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionOrder()
    {
        if (Preorders::placeOrder(Yii::$app->request->post(),Yii::$app->request->userIP)) {
            return $this->redirect(Url::previous());
        } else {
            return $this->redirect(Url::previous());
        }
    }


    public function actionStat()
    {
        Url::remember();
        $this->layout = 'stat';
        $dataProvider = new ActiveDataProvider([
            'query' => Preorders::find(),
            'pagination'=> [
                'pageSize' => 100,
            ],
            'sort' =>[
                'defaultOrder'=> [
                    'id' => SORT_DESC
                ]
            ]
        ]);

        return $this->render('stat', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionPreorderView($id)
    {
        Url::remember();
        $this->layout = 'stat';
        $preorder = Preorders::findOne(['id'=>$id]);
        if (!$preorder) {
            Yii::$app->session->addFlash('error', 'Нет такого заказа');
            return $this->redirect(Url::previous());
        }

        return $this->render('preorder-view', [
            'model' => $preorder,
        ]);
    }
}
