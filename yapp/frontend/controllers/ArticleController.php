<?php

namespace frontend\controllers;

use common\models\Article;

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


class ArticleController extends Controller
{
    public $defaultAction = 'page';
    public $article;




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

    public function actionIndex()
    {
        Url::remember();
        $utm = $this->getUtm();
        $this->view->params['currentItem']=13;
        $this->article = Article::find()
            ->where(['site'=>Yii::$app->params['site']])
            ->andwhere(['hrurl'=>'index'])
            ->one();
        $sections = $this->article->sections;
        if ($this->article->layout == null) {
            $this->layout = 'article';
        } else {
            $this->layout = $this->article->layout;
        }
        $this->view->params['meta']=$this->article;

        return $this->render('part_views/article/'.$this->article->view,[
            'article' => $this->article,
            'sections' => $sections,
            'utm' => $utm,
        ]);
    }

    public function actionArticle()
    {
        Url::remember();
        $utm = $this->getUtm();

        $hrurl = Yii::$app->request->get('pagename');


        $this->article = Article::find()
            ->where(['site'=>Yii::$app->params['site']])
            ->andwhere(['hrurl'=>'perevozki-dlya-juridicheskih-lits'])
            ->one();
        $sections = $this->article->sections;
        if ($this->article->layout == null) {
            $this->layout = 'article';
        } else {
            $this->layout = $this->article->layout;
        }
        $this->view->params['meta']=$this->article;
        $this->view->params['currentItem']=14;

        return $this->render('part_views/article/'.$this->article->view,[
            'article' => $this->article,
            'sections' => $sections,
            'utm' => $utm,
        ]);
    }

    public function actionPage($hrurl=null)
    {

        Url::remember();
        $utm = $this->getUtm();

        if ($hrurl == null) {
            $hrurl = Yii::$app->request->get('pagename');
        }

        $this->article = Article::find()
            ->where(['site'=>Yii::$app->params['site']])
            ->andwhere(['hrurl'=>$hrurl])
            ->one();

        $sections = $this->article->sections;


        if ($this->article->layout == null ) {
            $this->layout = 'article';
        } else {
            $this->layout = $this->article->layout;
        }

        $this->view->params['meta']=$this->article;
        $this->view->params['currentItem']=14;

        return $this->render('article_view',[
            'article' => $this->article,
            'model' => $this->article,
            'sections' => $sections,
            'utm' => $utm,
        ]);
//        return $this->render($this->article->view,[
//            'article' => $this->article,
//            'sections' => $sections,
//            'utm' => $utm,
//        ]);
    }




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


    public function actionCalculator()
    {
        if (Yii::$app->request->isPost) {

//            $request = Yii::$app->request->post('PriceCalculator');
//            return PriceCalculator::calculate($request['from_city_id'],$request['to_city_id'],$request['truck_id'],$request['shipment_type']);
        }
    }


}
