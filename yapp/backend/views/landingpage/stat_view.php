<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\LandingPage */

$this->title = $model->name . ' - cтатистика';
$this->params['breadcrumbs'][] = ['label' => 'Landing Pages', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="landing-page-view">

    <h1><?= Html::encode($this->title) ?></h1>



    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
//            'id',
            'name',
//            'hrurl:url',
//            Html::a($model['hrurl'], ['/t/'.$model['hrurl']]),
            [
                'attribute'=>'hrurl',
                'value'=> Html::a($model['hrurl'], ['/lp/'.$model['hrurl']]),
                'format'=> 'html',
            ],
            'seo_logo:ntext',
            'title',
            'description:ntext',
            'keywords:ntext',
//            'view',
//            'layout',
//            'color',
        ],
    ]) ?>
<h2>Просмотры</h2>
    <?= \yii\grid\GridView::widget([
        'dataProvider' => $visitsProvider,
        'columns' => [
//            'lp_hrurl',
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
