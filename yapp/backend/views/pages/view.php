<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Pages */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Pages', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pages-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'status',
            'id',
            'service_type',
            'site',
            'hrurl',
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
                                if ($cat->tree==0) {
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
            'title',
            'seo_logo',
            'description:ntext',
            'keywords:ntext',
            'pagehead',
            'pagedescription:ntext',
            'text:ntext',
            'imagelink',
            'imagelink_alt',
            'sendtopage',
            'promolink',
            'promoname',
            'view',
            'layout',
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
    ]) ?>

</div>
