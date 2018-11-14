<?php
namespace backend\controllers;

use common\models\Preorders;
use Yii;
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

//        $preorder = new Preorders();
//        if ($preorder->load(Yii::$app->request->post())) {
//            $spamOrders = Preorders::find()
//                ->where(['ip'=>Yii::$app->request->userIP])
//                ->andWhere(['>','date',time()-86400])
//                ->all();
//
//            if ( count($spamOrders)  > 5) {
//                Yii::$app->session->setFlash('error', 'Вы достигли лимита отправляемых заявок. <br> Свяжитесь с нами по телефону');
//                return $this->redirect(Url::previous());
//            }
//            $preorder['site'] = Yii::$app->params['site'];
//            $preorder['ip'] = Yii::$app->request->userIP;
//            if ($preorder->save()) {
//                if ($preorder->sendEmail( Yii::$app->params['site'].': Заявка')) {
//                    Yii::$app->session->setFlash('success', 'Ваша заявка отправлена. <br> Мы свяжемся с Вами в ближайшее время.');
//                    return $this->redirect(Url::previous());
//                } else {
//                    Yii::$app->session->setFlash('error', 'Во время отправки произошла ошибка, попробуйте еще раз.');
//                    return $this->redirect(Url::previous());
//                }
//            } else {
//                Yii::$app->session->setFlash('error', 'Ошибка сохранения заявки. Оформите заявку по телефону.');
//                return $this->redirect(Url::previous());
//            }
//        } else {
//
//            Yii::$app->session->setFlash('error', 'Во время отправки произошла ошибка, попробуйте еще раз. Или отправьте заявку в свободной форме на zakaz@finlider.ru или оформите заявку по телефону');
//            return $this->redirect(Url::previous());
//        }

    }
}
