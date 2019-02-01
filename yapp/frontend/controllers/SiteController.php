<?php
namespace frontend\controllers;

use common\models\Pages;
use common\models\Preorders;
use common\models\Sitemap;
use common\models\Visit;
use Yii;
use yii\base\InvalidParamException;
use yii\helpers\Url;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Displays page.
     *
     * @return string
     */
    public function actionPage()
    {
        Url::remember();
        $preorderForm = new Preorders();

        $hrurl = Yii::$app->request->get('pagename');


        $page = Pages::find()->where([
            'site'=>Yii::$app->params['site'],
            'hrurl'=>$hrurl
        ])->one();
        if ($page == false) {
            throw new \yii\web\NotFoundHttpException('Страница не существует');
        };
        if ($page->status == 'article') {
            return Yii::$app->runAction('article/page', ['hrurl' => $hrurl]);
        }

        $utm = $this->getUtm();
        if (!empty($page->layout)) {
            $this->layout = $page->layout;
        }


        $this->view->params['pageName']=$hrurl;
        if (trim(strtolower($page->seo_logo)) =='title') {
            $page->seo_logo = $page->title;
        }
        $this->view->params['meta']=$page;
        if ($hrurl == 'sitemap') {
            return $this->render('sitemap',[
                'page' => $page,
                'preorderForm' => $preorderForm,
            ]);
        }
        if (!empty($page->view)) {
            return $this->render($page->view,[
                'page' => $page,
                'preorderForm' => $preorderForm,
            ]);
        }
        return $this->render('page',[
            'page' => $page,
            'preorderForm' => $preorderForm,
        ]);


    }



    /**
     * Logs in a user.
     *
     * @return mixed
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
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }



    public function actionFeedback()
    {
        $feedback = new Preorders();
        if ($feedback->load(Yii::$app->request->post())) {
            $spamOrders = Preorders::find()
                ->where(['ip'=>Yii::$app->request->userIP])
                ->andWhere(['>','date',time()-86400])
                ->all();
            $spamFeedbacks = Preorders::find()  // feedbacks
                ->where(['ip'=>Yii::$app->request->userIP])
                ->andWhere(['>','date',time()-86400])
                ->all();

            if (count($spamOrders) + count($spamFeedbacks) > 5) {
                Yii::$app->session->setFlash('error', 'Вы достигли лимита отправляемых заявок. <br> Свяжитесь с нами по телефону');
                return $this->redirect(Url::previous());
            }
            $feedback['site'] = Yii::$app->params['site'];
            $feedback['ip'] = Yii::$app->request->userIP;
            if ( $feedback->save()) {
                if ($feedback->sendEmail( Yii::$app->params['site'].': Запрос обратного звонка')) {
                    Yii::$app->session->setFlash('success', 'Ваша заявка отправлена. <br> Мы свяжемся с Вами в ближайшее время.');
                    return $this->redirect(Url::previous());
                } else {
                    Yii::$app->session->setFlash('error', 'Во время отправки произошла ошибка, попробуйте еще раз.');
                    return $this->redirect(Url::previous());
                }
            } else {
                Yii::$app->session->setFlash('error', 'Ошибка сохранения заявки. Оформите заявку по телефону.');
                return $this->redirect(Url::previous());
            }

        } else {
            Yii::$app->session->setFlash('error', 'Во время отправки произошла ошибка, попробуйте еще раз. Или отправьте заявку в свободной форме на transzakaz@gmail.com или оформите заявку по телефону');
            return $this->redirect(Url::previous());
        }

    }

//  // OLD  ORDER

//    public function actionOrder()
//    {
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
//
//    }

    public function getUtm()
    {
        $utm = [];
        $session = Yii::$app->session;

        if (Yii::$app->request->get('utm_source')) {
            // UTM из GET
            $utm['source'] = Yii::$app->request->get('utm_source');
            $utm['medium'] = Yii::$app->request->get('utm_medium');
            $utm['campaign'] = Yii::$app->request->get('utm_campaign');
            $utm['term'] = Yii::$app->request->get('utm_term');
            $utm['content'] = Yii::$app->request->get('utm_content');

            // сохранение в сессию
            if (Yii::$app->request->get('utm_source')!= null) {
                $session['utm_source'] = $utm['source'];
                $session['utm_medium'] = $utm['medium'];
                $session['utm_campaign'] = $utm['campaign'];
                $session['utm_term'] = $utm['term'];
                $session['utm_content'] = $utm['content'];
            }
        } else {
            if ($session['utm_source']) {
                $utm['source'] = $session['utm_source'];
                $utm['medium'] = $session['utm_medium'];
                $utm['campaign'] = $session['utm_campaign'];
                $utm['term'] = $session['utm_term'];
                $utm['content'] = $session['utm_content'];
            } else { // если там что то есть
                $utm['source'] = Yii::$app->request->get('utm_source');
                $utm['medium'] = Yii::$app->request->get('utm_medium');
                $utm['campaign'] = Yii::$app->request->get('utm_campaign');
                $utm['term'] = Yii::$app->request->get('utm_term');
                $utm['content'] = Yii::$app->request->get('utm_content');
            }
        }

        //сохр визита в статистику
        $visit = new Visit();
        $visit['ip'] = Yii::$app->request->userIP;
        $visit['site'] = Yii::$app->params['site'];
        $visit['lp_hrurl'] = '';
        $visit['url'] = 'http://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
        $visit['utm_source']=$utm['source'];
        $visit['utm_medium']=$utm['medium'];
        $visit['utm_campaign']=$utm['campaign'];
        $visit['utm_term']=$utm['term'];
        $visit['utm_content']=$utm['content'];
        $visit['qnt']=1;
        $visit->save();

        return $utm;

    }

    public function actionSitemap()
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_RAW;
        Yii::$app->response->headers->add('Content-Type', 'text/xml');
        $sitemap = new Sitemap();
        return $this->renderPartial('sitemap', [
            'data' => $sitemap->getUrl(),
            'homeLastMod' => $sitemap->homeLastMod,
        ]);
    }

    public function actionOrder()
    {
        if (Preorders::placeOrder(Yii::$app->request->post(),Yii::$app->request->userIP)) {
            return $this->redirect(Url::previous());
        } else {
            return $this->redirect(Url::previous());
        }
    }
}
