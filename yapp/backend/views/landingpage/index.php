<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Landing Pages';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="landing-page-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>

    <p>
        <?= Html::a('Create Landing Page', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'site',
            'name',
            [
                'attribute'=>'hrurl',
                'value' => function($data)
                {
                    if (Yii::$app->request->getHostName() == 'cp.finlider.local') {
                        $lpSite = $data['site'];
                        $site = str_replace('.ru','.local',$lpSite);
                        $site = str_replace('.su','.local',$site);
                        return '<a  href="http://'.$site.'/lp/'.$data['hrurl'].'">'.$data['hrurl'].'</a>';
                    } else {
                        return '<a  href="http://'.$data['site'].'/lp/'.$data['hrurl'].'">'.$data['hrurl'].'</a>';
                    }
                },
                'format'=> 'html',
            ],
            'seo_logo:ntext',
            'title',
            // 'description:ntext',
            // 'keywords:ntext',
            // 'view',
            // 'layout',
            // 'color',

//            ['class' => 'yii\grid\ActionColumn'],
            [
                'class' => \yii\grid\ActionColumn::className(),
                'buttons' => [
                    'delete'=>function($url,$model){
                        $newUrl = Yii::$app->getUrlManager()->createUrl(['/admin/landingpage/stat','id'=>$model['id'],'days'=>'7']);
                        return \yii\helpers\Html::a( '<span class="glyphicon glyphicon-briefcase"></span>', $newUrl,
                            ['title' => Yii::t('yii', 'Статистика'), 'data-pjax' => '0']);
                    },
//                    'view'=>function($url,$model){
//                        return false;
//                    },
//                    'delete'=>function($url,$model){
//                        return false;
//                    },

                ]
            ],
            [
                'attribute'=>'created_at',
                'value' => function($data)
                {
                    return \Yii::$app->formatter->asDatetime($data['created_at'], 'dd/MM/yy HH:mm');
                },
                'format'=> 'html',
            ],
            [
                'attribute'=>'updated_at',
                'value' => function($data)
                {
                    return \Yii::$app->formatter->asDatetime($data['updated_at'], 'dd/MM/yy HH:mm');
                },
                'format'=> 'html',
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
