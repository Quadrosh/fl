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
            'id',
            [
                'class' => \yii\grid\ActionColumn::class,
                'buttons' => [
                    'view'=>function($url,$model){
                        $newUrl = Yii::$app->getUrlManager()->createUrl(['/site/preorder-view','id'=>$model['id']]);
                        return \yii\helpers\Html::a( '<span class="glyphicon glyphicon-eye-open"></span>', $newUrl,
                            [
                                'title' => Yii::t('yii', 'Открыть'),
                                'data-pjax' => '0',
                                'data-method'=>'post'
                            ]);
                    },
                    'delete'=>function($url,$model){
                        return false;
                    },
                    'update'=>function($url,$model){
                        return false;
                    },
                ]
            ],
            [
                'attribute'=>'date',
                'value' => function($data) {
                    return '<small>'. \Yii::$app->formatter->asDatetime($data['date'], 'HH:mm dd/MM/yy').'</small>';
                },
                'format'=> 'html',
            ],
            [
                'attribute'=>'ip', 'format'=> 'html',
                'value' => function($data) {
                    $res = $data->ip;
                    if(in_array( $res,Yii::$app->params['blocked_ips'])) {
                        $res = $res.'<sup class="text-danger">blocked<sup>';
                    }
                    return $res;
                },
            ],
//            'ip',
//            'site',
            'service_type',
//            'operation_id',
//            'platform',
//            'inn',
//            'name',
//            'phone',
//            'email:email',
            //'text:ntext',
//            'from_page',
            [
                'attribute'=>'from_page',
                'format'=> 'html',
                'contentOptions' => ['style' => 'font-size:.8rem;width:20%;line-height:1.1; white-space: normal;'],
                'value' => function($data) {
                    return $data->from_page;
                },
            ],




            'utm_source',
            'utm_medium',
            'utm_campaign',
            [
                'attribute'=>'utm_term',
                'format'=> 'html',
                'contentOptions' => ['style' => 'font-size:.8rem;width:20%;line-height:1.1; white-space: normal;'],
                'value' => function($data) {
                    return $data->utm_term;
                },
            ],
            [
                'attribute'=>'utm_content',
                'format'=> 'html',
                'contentOptions' => ['style' => 'font-size:.8rem;width:20%;line-height:1.1; white-space: normal;'],
                'value' => function($data) {
                    return $data->utm_content;
                },
            ],
            //'manager',
            //'quality',
            //'comment',
//            'date',

        ],
    ]); ?>
</div>
