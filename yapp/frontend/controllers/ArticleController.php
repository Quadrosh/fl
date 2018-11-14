<?php

namespace frontend\controllers;

use common\models\Article;

use common\models\Calc;
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
        Visit::setUtmVisit();

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

        ]);
    }

    public function actionPage($hrurl=null)
    {

//        Yii::$app->session->destroy(); die;
        Url::remember();
        Visit::setUtmVisit();

        if ($hrurl == null) {
            $hrurl = Yii::$app->request->get('pagename');
        }

        $this->article = Article::find()
            ->where(['site'=>Yii::$app->params['site']])
            ->andwhere(['hrurl'=>$hrurl])
            ->one();


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

        ]);

    }





    public function actionCalculator()
    {
        $params = Yii::$app->request->post('CalculatorForm');
        $calc=Calc::find()->where(['id'=>$params['calcId']])->one();
        return $calc->calculate($params);
    }



}
