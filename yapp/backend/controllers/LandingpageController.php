<?php

namespace backend\controllers;

use common\models\Feedback;
use common\models\LandingListitem;
use common\models\LandingSection;
use common\models\Preorders;
use common\models\Visit;
use Yii;
use common\models\LandingPage;
use yii\data\ActiveDataProvider;
use yii\data\ArrayDataProvider;
use yii\data\Sort;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * LandingpageController implements the CRUD actions for LandingPage model.
 */
class LandingpageController extends BackController
{


    /**
     * Lists all LandingPage models.
     * @return mixed
     */
    public function actionIndex()
    {
        Url::remember();
        $dataProvider = new ActiveDataProvider([
            'query' => LandingPage::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single LandingPage model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        Url::remember();
        $sections = LandingSection::find()->where(['page_id'=>$id])->orderBy('order_num')->all();
        $listItems = [];
        foreach ($sections as $section ) {
            $listIt = LandingListitem::find()->where(['section_id'=>$section['id']])->orderBy('order_num')->all();
            foreach ($listIt as $item) {
                $listItems[] = $item;
            }
        }
        return $this->render('view', [
            'model' => $this->findModel($id),
            'sections'=> $sections,
            'listItems'=> $listItems,
        ]);
    }

    /**
     * Displays a LandingPage statistics.
     * @param integer $id
     * @return mixed
     */
    public function actionStat($days)
    {
        Url::remember();
        $daysAgo = $days;
        $today = time();
        $oldTime = $today - ($daysAgo*86400); // 24*60*60 = 86400
        $startPeriod = $oldTime - ($oldTime % 86400)-(3*60*60);


        $visitsByDay=[];
        for($dayStart = $startPeriod; $dayStart < $today + 86400; $dayStart += 86400){ // +=
            $dayEnd = $dayStart + 86400;
            $rawVisits = Visit::find()
                ->where(['>','created_at',$dayStart])
                ->andWhere(['<','created_at',$dayEnd])
                ->andWhere(['comment'=>null])
                ->orderBy([
                    'lp_hrurl'=> SORT_ASC,
                    'utm_source'=> SORT_ASC,
                    'utm_medium'=> SORT_ASC,
                    'utm_campaign'=> SORT_ASC
                ])
                ->asArray()
                ->all();

            $compVisits = Visit::find()
                ->where(['>','comment',$dayStart])
                ->andWhere(['<','comment',$dayEnd])
                ->orderBy([
                    'lp_hrurl'=> SORT_ASC,
                    'utm_source'=> SORT_ASC,
                    'utm_medium'=> SORT_ASC,
                    'utm_campaign'=> SORT_ASC
                ])
                ->asArray()
                ->all();
            $allVisits = $rawVisits;
            foreach ($compVisits as $compVisit) {
                $compVisit['created_at'] = $compVisit['comment'];
                array_push($allVisits,$compVisit);
            }

            $preorders = Preorders::find()
                ->where(['>','date',$dayStart])
                ->andWhere(['<','date',$dayEnd])
                ->asArray()
                ->all();
            foreach ($preorders as $preorder) {
                $preorder['created_at'] = $preorder['date'];
                $preorder['lp_hrurl'] = $preorder['from_page'];
                $preorder['lead'] = 1;
                array_push($allVisits,$preorder);
            }

            $feedbacks = Feedback::find()
                ->where(['>','date',$dayStart])
                ->andWhere(['<','date',$dayEnd])
                ->asArray()
                ->all();
            foreach ($feedbacks as $feedback) {
                $feedback['created_at'] = $feedback['date'];
                $feedback['lp_hrurl'] = $feedback['from_page'];
                $feedback['lead'] = 1;
                array_push($allVisits,$feedback);
            }

            ArrayHelper::multisort($allVisits,['lp_hrurl','utm_source','utm_medium','utm_campaign'],[SORT_ASC,SORT_ASC,SORT_ASC,SORT_ASC]);

            if ($allVisits!=null) {
                $visitsByDay[] = $allVisits;
            }
        }

        $vbdi = 0;
        $sumVisitsByDay = [];
        foreach ($visitsByDay as $visits) {
            $sumVisitsByDay[$vbdi] = [];
            $oldVisit = null;

            foreach ($visits as $visit) {
                if($oldVisit == null){
                    $sumVisitsByDay[$vbdi]['site'] = $visit['site'];
                    $sumVisitsByDay[$vbdi]['lp_hrurl'] = $visit['lp_hrurl'];
                    $sumVisitsByDay[$vbdi]['utm_source'] = $visit['utm_source'] ;
                    $sumVisitsByDay[$vbdi]['utm_medium'] = $visit['utm_medium'] ;
                    $sumVisitsByDay[$vbdi]['utm_campaign'] = $visit['utm_campaign'] ;
                    $sumVisitsByDay[$vbdi]['views'] = isset($visit['qnt'])?$visit['qnt']:null;
                    $sumVisitsByDay[$vbdi]['lead'] = isset($visit['lead'])?$visit['lead']:null;
                    $sumVisitsByDay[$vbdi]['date'] = $visit['created_at'];
                    $oldVisit = $sumVisitsByDay[$vbdi];
                } else {
                    if($visit['lp_hrurl'] == $oldVisit['lp_hrurl']){
                        if ($visit['utm_source']==$oldVisit['utm_source']) {
                            if($visit['utm_medium']==$oldVisit['utm_medium']){
                                if ($visit['utm_campaign']==$oldVisit['utm_campaign']) {
                                    $sumVisitsByDay[$vbdi]['views'] += isset($visit['qnt'])?$visit['qnt']:null;
                                    $sumVisitsByDay[$vbdi]['lead'] += isset($visit['lead'])?$visit['lead']:null;
                                } else {   // $visit['utm_campaign']!=$oldVisit['utm_campaign']
                                    $vbdi++;
                                    $sumVisitsByDay[$vbdi]['site'] = $visit['site'];
                                    $sumVisitsByDay[$vbdi]['lp_hrurl'] = $visit['lp_hrurl'];
                                    $sumVisitsByDay[$vbdi]['utm_source'] = $visit['utm_source'];
                                    $sumVisitsByDay[$vbdi]['utm_medium'] = $visit['utm_medium'];
                                    $sumVisitsByDay[$vbdi]['utm_campaign'] = $visit['utm_campaign'];
                                    $sumVisitsByDay[$vbdi]['date'] = $visit['created_at'];
                                    $sumVisitsByDay[$vbdi]['views'] = isset($visit['qnt'])?$visit['qnt']:null;
                                    $sumVisitsByDay[$vbdi]['lead'] = isset($visit['lead'])?$visit['lead']:null;
                                    $oldVisit = $sumVisitsByDay[$vbdi];
                                }
                            } else {   // $visit['utm_medium']!=$oldVisit['utm_medium']
                                $vbdi++;
                                $sumVisitsByDay[$vbdi]['site'] = $visit['site'];
                                $sumVisitsByDay[$vbdi]['lp_hrurl'] = $visit['lp_hrurl'];
                                $sumVisitsByDay[$vbdi]['utm_source'] = $visit['utm_source'];
                                $sumVisitsByDay[$vbdi]['utm_medium'] = $visit['utm_medium'];
                                $sumVisitsByDay[$vbdi]['utm_campaign'] = $visit['utm_campaign'];
                                $sumVisitsByDay[$vbdi]['date'] = $visit['created_at'];
                                $sumVisitsByDay[$vbdi]['views'] = isset($visit['qnt'])?$visit['qnt']:null;
                                $sumVisitsByDay[$vbdi]['lead'] = isset($visit['lead'])?$visit['lead']:null;
                                $oldVisit = $sumVisitsByDay[$vbdi];
                            }
                        } else {   // $visit['utm_source']!=$oldVisit['utm_source']
                            $vbdi++;
                            $sumVisitsByDay[$vbdi]['site'] = $visit['site'];
                            $sumVisitsByDay[$vbdi]['lp_hrurl'] = $visit['lp_hrurl'];
                            $sumVisitsByDay[$vbdi]['utm_source'] = $visit['utm_source'];
                            $sumVisitsByDay[$vbdi]['utm_medium'] = $visit['utm_medium'];
                            $sumVisitsByDay[$vbdi]['utm_campaign'] = $visit['utm_campaign'];
                            $sumVisitsByDay[$vbdi]['date'] = $visit['created_at'];
                            $sumVisitsByDay[$vbdi]['views'] = isset($visit['qnt'])?$visit['qnt']:null;
                            $sumVisitsByDay[$vbdi]['lead'] = isset($visit['lead'])?$visit['lead']:null;
                            $oldVisit = $sumVisitsByDay[$vbdi];
                        }
                    } else { //   $visit['lp_hrurl'] != $oldVisit['lp_hrurl']
                        $vbdi++;
                        $sumVisitsByDay[$vbdi]['site'] = $visit['site'];
                        $sumVisitsByDay[$vbdi]['lp_hrurl'] = $visit['lp_hrurl'];
                        $sumVisitsByDay[$vbdi]['utm_source'] = $visit['utm_source'];
                        $sumVisitsByDay[$vbdi]['utm_medium'] = $visit['utm_medium'];
                        $sumVisitsByDay[$vbdi]['utm_campaign'] = $visit['utm_campaign'];
                        $sumVisitsByDay[$vbdi]['date'] =  $visit['created_at'];
                        $sumVisitsByDay[$vbdi]['views'] = isset($visit['qnt'])?$visit['qnt']:null;
                        $sumVisitsByDay[$vbdi]['lead'] = isset($visit['lead'])?$visit['lead']:null;
                        $oldVisit =  $sumVisitsByDay[$vbdi];
                    }
                }
            }
            $vbdi++;
        }


        $visitsProvider = new ArrayDataProvider([
            'allModels' => $sumVisitsByDay,
            'sort'=>[
                'attributes'=>['date','views','lead'],
                'defaultOrder' => ['date'=>SORT_DESC],
            ],
            'pagination' => [
                'pageSize' => 100,
            ],
        ]);

        $LpModelId = Yii::$app->request->get('id');


        if ($LpModelId) {
            $LpModel = LandingPage::find()->where(['id'=>$LpModelId])->one();
            return $this->render('stat_view', [
                'model' => $LpModel,
                'visitsProvider' => $visitsProvider,
            ]);
        } else {
            return $this->render('stat', [
                'visitsProvider' => $visitsProvider,
                'sumVisitsByDay' => $sumVisitsByDay,
            ]);
        }

    }


    public  function actionAltToSvg($id){
        $landingPage = LandingPage::find()->where(['id'=>$id])->one();
        $sections = $landingPage->sections;
        foreach ($sections as $section) {
            $listItems = $section->listItems;
            foreach ($listItems as $listItem) {
//                $text = str_replace('#'.$var['item_var_id'],$var['value'], $text);
//
                $wString =  $listItem['image'];

//                $lbStart = strpos($wString,'aria-labelledby="svg_li_')+24;
//                $lbEnd = strpos($wString,'_title"');
//                $lbCount = $lbEnd - $lbStart;
//                $lbValue = substr($wString,$lbStart,$lbCount);
//                $lbReplace = str_replace('aria-labelledby="svg_li_'.$lbValue,'aria-labelledby="svg_li_'.$listItem['id'],$wString);
                if (strpos($wString,'aria-labelledby="svg_li_')) {
                    $lbId= $this->replace(
                        $wString,
                        'aria-labelledby="svg_li_',
                        '_title"',
                        $listItem['id']
                    );
                    $titleId = $this->replace(
                        $lbId,
                        '<title id="svg_li_',
                        '_title">',
                        $listItem['id']
                    );
                    $alt2title = $this->replace(
                        $titleId,
                        '<title id="svg_li_'.$listItem['id'].'_title">',
                        '</title>',
                        $listItem['image_alt']
                    );
                    $listItem['image']=$alt2title;
                    $listItem->save();
                }

//
//                $listItem['image'] = str_replace('$alt$',$listItem['image_alt'], $listItem['image']);
//                $listItem['image'] = str_replace('$id$',$listItem['id'], $listItem['image']);
//                $listItem->save();
            }
        }
        return $this->redirect(Url::previous());
    }
    private function replace($string,$startKey,$endKey,$replace){

        $start = strpos($string,$startKey)+strlen($startKey);
        $end = strpos($string,$endKey);
        $count = $end - $start;
        $value = substr($string,$start,$count);

        return str_replace($startKey.$value,$startKey.$replace,$string);
    }
    /**
     * Creates a new LandingPage model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new LandingPage();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(Url::previous());
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing LandingPage model.
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
     * Deletes an existing LandingPage model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Copy landing page with sections and list items
     */
    public function actionCopy($id)
    {
        $source = LandingPage::findOne(['id'=>$id]);
        $newLP = new LandingPage();
        $newLP->setAttributes($source->attributes);
        $newLP['name']=$source['name'].' - Копия';
        $newLP['hrurl']=$source['hrurl'].'_copy';
        $newLP->save();
        $sourceSections = LandingSection::find()->where(['page_id'=>$id])->orderBy('order_num')->all();
        foreach ($sourceSections as $sourceSection) {
            $newSection = new LandingSection();
            $newSection->setAttributes($sourceSection->attributes);
            $newSection['page_id']=$newLP['id'];
            $newSection->save();
            $sourceListItems = LandingListitem::find()->where(['section_id'=>$sourceSection['id']])->orderBy('order_num')->all();
            if ($sourceListItems) {
                foreach ($sourceListItems as $sourceListItem) {
                    $newListItem = new LandingListitem();
                    $newListItem->setAttributes($sourceListItem->attributes);
                    $newListItem['section_id']=$newSection['id'];
                    $newListItem->save();
                }
            }
        }

//        var_dump($newLP); die;

        return $this->redirect(['/landingpage/view','id'=>$newLP['id']]);
    }

    /**
     * Finds the LandingPage model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return LandingPage the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = LandingPage::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
