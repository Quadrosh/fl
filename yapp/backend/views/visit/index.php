<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Визиты ';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="visit-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <p>Системное время <?= \Yii::$app->formatter->asDatetime(time(), 'HH:mm dd/MM/yy') ?></p>
    <?php Pjax::begin(); ?>

    <p>
<!--        --><?//= Html::a('Create Visit', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'site',
            'lp_hrurl',
            'ip',
//            'city',
//            'url:url',
            'utm_source',
             'utm_medium',
             'utm_campaign',
             'utm_term',
             'utm_content',
             'qnt',
//             'comment',
            [
                'attribute'=>'comment',
                'value' => function($data)
                {
                    return \Yii::$app->formatter->asDatetime($data['comment'], 'dd/MM/yy');
                },
                'format'=> 'html',
            ],
//             'created_at',
            [
                'attribute'=>'created_at',
                'value' => function($data)
                {
                    return \Yii::$app->formatter->asDatetime($data['created_at'], 'HH:mm dd/MM/yy');
                },
                'format'=> 'html',
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
<!--\Yii::$app->formatter->asDatetime($lead['date']. \Yii::$app->getTimeZone(), 'HH:mm dd/MM/yy');-->
