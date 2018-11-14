<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pages';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pages-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Pages', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'site',
            'hrurl',
            'title',
            'description:ntext',

            [
                'attribute'=>'cat_ids',
                'value' => function($model)
                {
                    $rawIds = $model['cat_ids'];
                    $out='';
                    $ids = json_decode($rawIds);
                    $i=0;
                    if ($ids) {
                        foreach ($ids as $id) {
                            $cat=\common\models\Menu::find()->where(['id'=>$id])->one();
                            if (isset($cat)) {
                                if ( $cat->tree==0) {
                                    $cat->tree=1;
                                }
                                $menu=\common\models\Menu::find()->where(['id'=>$cat->tree])->one();
                                $out .=$menu->name.'->'.$cat->name;
                                if (count($ids)-1>$i) {
                                    $out .=', ';
                                }
                                $i++;
                            }

                        }

                    }
                    return $out;

                },
                'format'=> 'html',
                'label'=> 'Категории в каталоге',
            ],
            'status',
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
//            'keywords:ntext',
//            'pagehead',
            // 'pagedescription:ntext',
            // 'text:ntext',
            // 'imagelink',
            // 'imagelink_alt',
            // 'sendtopage',
            // 'promolink',
            // 'promoname',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
