<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Заявки с UTM';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="preorders-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <p>Системное время <?= \Yii::$app->formatter->asDatetime(time(), 'HH:mm dd/MM/yy') ?></p>



    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'ip',
//            'site',
            'service_type',
//            'operation_id',
//            'platform',
//            'inn',
//            'name',
//            'phone',
//            'email:email',
            //'text:ntext',
            'from_page',
            'utm_source',
            'utm_medium',
            'utm_campaign',
            'utm_term',
            'utm_content',
            //'manager',
            //'quality',
            //'comment',
//            'date',
            [
                'attribute'=>'date',
                'value' => function($data)
                {
                    return \Yii::$app->formatter->asDatetime($data['date'], 'HH:mm dd/MM/yy');
                },
                'format'=> 'html',
            ],
            //'done',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
