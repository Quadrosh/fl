<?php
namespace common\models;
use Yii;
use yii\base\Model;


class Sitemap extends Model
{
    public $site;
    public $homeLastMod;

    public function getUrl(){
        $urls = [];
        $pages = Pages::find()->where(['site'=>Yii::$app->params['site'],'status'=>'published'])->all();
        $lp = LandingPage::find()->where(['site'=>Yii::$app->params['site'],'hrurl'=>'home'])->one();
        $this->homeLastMod = $lp?\Yii::$app->formatter->asDatetime($lp->updated_at, 'yyyy-MM-dd'):null;
        foreach ($pages as $page){
            if ($page->hrurl=='home') {
                $this->homeLastMod =  \Yii::$app->formatter->asDatetime($page->updated_at, 'yyyy-MM-dd');
            } else{
                $urls[]=[
                    'url'=>Yii::$app->urlManager->createUrl([$page->hrurl]),
                    'changefreq'=>'daily',
                    'lastmod'=> \Yii::$app->formatter->asDatetime($page->updated_at, 'yyyy-MM-dd')
                ];
            }
        }

        $articlePages = Article::find()
            ->where([
                'site'=>Yii::$app->params['site'],
                'status'=>'page'
            ])->all();

        foreach ($articlePages as $article){
            if ($article->hrurl=='home') {
                $this->homeLastMod =  \Yii::$app->formatter->asDatetime($article->updated_at, 'yyyy-MM-dd');
            } else {
                $urls[]=[
                    'url'=>Yii::$app->urlManager->createUrl([$article->hrurl]),
                    'changefreq'=>'daily',
                    'lastmod'=> \Yii::$app->formatter->asDatetime($article->updated_at, 'yyyy-MM-dd')
                ];
            }
        }
        $articles = Article::find()
            ->where([
                'site'=>Yii::$app->params['site'],
                'status'=>'published'
            ])->all();

        foreach ($articles as $article){
            if ($article->hrurl=='home') {
                $this->homeLastMod =  \Yii::$app->formatter->asDatetime($article->updated_at, 'yyyy-MM-dd');
            } else {
                $urls[]=[
                    'url'=>Yii::$app->urlManager->createUrl(['article/'.$article->hrurl]),
                    'changefreq'=>'daily',
                    'lastmod'=> \Yii::$app->formatter->asDatetime($article->updated_at, 'yyyy-MM-dd')
                ];
            }
        }
        return $urls;
    }


}