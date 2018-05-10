<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\LandingPage */

$this->title = 'LandingPage - Stat by day';
$this->params['breadcrumbs'][] = ['label' => 'Landing Pages', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

if (Yii::$app->request->get('noempty')) {
    $newProvider = [];
    foreach ($sumVisitsByDay as $record) {
        if ($record['utm_source']!=null) {
            $newProvider[]= $record;
        }
    }

    $visitsProvider = new \yii\data\ArrayDataProvider([
        'allModels' => $newProvider,
        'sort'=>[
            'attributes'=>['date','views','lead'],
            'defaultOrder' => ['date'=>SORT_DESC],
        ],
        'pagination' => [
            'pageSize' => 100,
        ],
    ]);
}
?>
<div class="landing-page-view">

    <h1><?= Html::encode($this->title) ?></h1>



<h4>Просмотры за <?= Yii::$app->request->get('days') ?> дней <?= Yii::$app->request->get('noempty')?'с UTM':'' ?></h4>
    <?= Html::beginForm(['/landingpage/stat'], 'get', ['enctype' => 'multipart/form-data']);   ?>
    <?= Html::input('text', 'days', Yii::$app->request->get('days'), ['class' => 'input30']) ?> дней
    <?= Html::checkbox('noempty', Yii::$app->request->get('noempty'), ['label' => 'без пустых']) ?>
    <?= Html::submitButton('Показать', ['class' => 'btn btn-primary btn-xs']) ?>
    <?= Html::endForm() ?>


    <?= \yii\grid\GridView::widget([
        'dataProvider' => $visitsProvider,
        'columns' => [
            'site',
            [
                'attribute'=>'lp_hrurl',
                'label'=> 'Страница',
            ],
            'utm_source',
            'utm_medium',
            'utm_campaign',
//            'views',
            [
                'attribute'=>'views',
                'label'=> 'Просмотры',
            ],
//            'lead',
            [
                'attribute'=>'lead',
                'label'=> 'Заявки',
            ],
            [
                'attribute'=>'k',
                'label'=> 'k%',
                'value' => function($data)
                {
                    return $data['views']!=0 ? round($data['lead'] / $data['views']*100).'%' : 0;
                },
            ],
//            'date',
            [
                'attribute'=>'date',
                'value' => function($data)
                {
                    return \Yii::$app->formatter->asDatetime($data['date'], 'dd/MM/yy');
                },
                'format'=> 'html',
            ],
        ],
    ]); ?>

</div>
