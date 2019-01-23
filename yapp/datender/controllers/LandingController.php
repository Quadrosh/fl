<?php

namespace datender\controllers;


use common\models\LandingListitem;
use common\models\LandingPage;
use common\models\LandingSection;
use common\models\Preorders;
use common\models\Visit;
use Yii;
use yii\base\Exception;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\web\Controller;


class LandingController extends Controller
{
    public $defaultAction = 'page';
    public $landingPage;




    /**
     * @inheritdoc
     */
    public function actions()
    {
        return
            [
                'error' => [
                    'class' => 'yii\web\ErrorAction',
                    'view' => '@app/views/site/custom_error.php',
                ],
                'rateLimiter' => [
                    'class' => \yii\filters\RateLimiter::className(),
                ],

        ];
    }


    /**
     * Displays page.
     *
     */
    public function actionPage()
    {
        Url::remember();

//        var_dump(Yii::$app->request->url); die;

        $PageName = Yii::$app->request->get('landingpage');

        if (!$PageName) {
            $PageName = 'home';
        }
        if (substr(Yii::$app->request->url,0,12) == '/tender_zaim') {
            $PageName = 'tender_zaim';
        } elseif (substr(Yii::$app->request->url,0,12) == '/bank_garant'){
            $PageName = 'bank_garant';
        }
        $utm = [];
        $session = Yii::$app->session;
//        $session->destroy();

        if (Yii::$app->request->get('utm_source')) {   // если в GET есть UTM
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
        } else {   // если GET пуст
            if (isset($session['utm_source'])) { // если в сессии что-то есть
                $utm['source'] = $session['utm_source'];
                $utm['medium'] = $session['utm_medium'];
                $utm['campaign'] = $session['utm_campaign'];
                $utm['term'] = $session['utm_term'];
                $utm['content'] = $session['utm_content'];
            } else {   //  должны быть, даже если пустые
                $utm['source'] = null;
                $utm['medium'] = null;
                $utm['campaign'] = null;
                $utm['term'] = null;
                $utm['content'] = null;
            }
        }

//        var_dump($utm);

        //сохр визита в статистику
        if (!isset($session['vizit_id'])) {  // если визита не было
            $visit = new Visit();

            $visit['ip'] = Yii::$app->request->userIP;
            $visit['site'] = Yii::$app->params['site'];
            $visit['lp_hrurl'] = $PageName;
            $visit['url'] = 'http://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];

            $visit['utm_source'] = $utm['source'];
            $visit['utm_medium'] = $utm['medium'];
            $visit['utm_campaign'] = $utm['campaign'];
            $visit['utm_term'] = $utm['term'];
            $visit['utm_content'] = $utm['content'];

            $visit['qnt']=1;
            $visit->save();

            $session['vizit_id'] = $visit['id'];
        } else { // если визит уже есть в сессии
            $visit = Visit::find()->where(['id'=>$session['vizit_id']])->one();
            if ($visit['created_at'] < time() - 43200) {   //86400  24 васа    43200 12 часов
                $visit = new Visit();

                $visit['ip'] = Yii::$app->request->userIP;
                $visit['site'] = Yii::$app->params['site'];
                $visit['lp_hrurl'] = $PageName;
                $visit['url'] = 'http://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];

                $visit['utm_source'] = $utm['source'];
                $visit['utm_medium'] = $utm['medium'];
                $visit['utm_campaign'] = $utm['campaign'];
                $visit['utm_term'] = $utm['term'];
                $visit['utm_content'] = $utm['content'];

                $visit['qnt']=1;
                $visit->save();

                $session['vizit_id'] = $visit['id'];
            } else {
                $visit['qnt'] = $visit['qnt']+1;
                $visit->save();
            }

        }



        $this->landingPage = LandingPage::find()
            ->where(['site'=>Yii::$app->params['site']])
            ->andwhere(['hrurl'=>$PageName])
            ->one();
        if ($PageName == null OR $this->landingPage == null)  {
            throw new \yii\web\NotFoundHttpException('Страница не существует');
        }
        if ($this->landingPage->layout == null) {
            $this->layout = 'landing';
        } else {
            $this->layout = $this->landingPage->layout;
        }
        if (trim(strtolower($this->landingPage['seo_logo'])) =='title') {
            $this->landingPage['seo_logo'] = $this->landingPage['title'];
        }
        $this->view->params['meta']=$this->landingPage;

        //секции
        $allSections = LandingSection::find()
            ->where(['page_id'=>$this->landingPage->id])
            ->orderBy('order_num')
            ->all();
        $sections = [];

        foreach ($allSections as $allSectionItem) {
            $allSection = $allSectionItem->toArray();
            if ($allSection['section_type']=='top') {
                $sections['top'] = $allSection;
            }
            elseif ($allSection['section_type']=='undertop'){
                $sections['undertop'] = $allSection;
            }
            elseif ($allSection['section_type']=='garage'){
                $sections['garage'] = $allSection;
            }
            elseif ($allSection['section_type']=='action_permanent'){
                $sections['action'] = $allSection;
            }
            elseif ($allSection['section_type']=='services'){
                $sections['services'] = $allSection;
            }
            elseif ($allSection['section_type']=='call2action'){
                $sections['call2action'] = $allSection;
            }
            elseif ($allSection['section_type']=='why_we'){
                $sections['whyWe'] = $allSection;
            }
            elseif ($allSection['section_type']=='how_we_work'){
                $sections['howWeWork'] = $allSection;
            }
            elseif ($allSection['section_type']=='numbers'){
                $sections['numbers'] = $allSection;
            }
            elseif ($allSection['section_type']=='projects'){
                $sections['projects'] = $allSection;
            }
            elseif ($allSection['section_type']=='reviews'){
                $sections['reviews'] = $allSection;
            }
            elseif ($allSection['section_type']=='clients'){
                $sections['clients'] = $allSection;
            }
            elseif ($allSection['section_type']=='order_form'){
                $sections['order'] = $allSection;
            }
            elseif ($allSection['section_type']=='what_we_do'){
                $sections['whatWeDo'] = $allSection;
            }

        }


        $preorderForm = new Preorders();



//        Yii::$app->session->setFlash('success', "Your message to display");


        return $this->render($this->landingPage->view,[
            'page' => $this->landingPage,
            'sections' => $sections,
            'preorderForm' => $preorderForm,
            'utm' => $utm,
        ]);
    }






}
