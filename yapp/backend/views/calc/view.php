<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Calc */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Calcs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="calc-view">

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
            'id',
            'bank_id',
            'fl_code',
            'interest_rate',
            'name',
            'description:ntext',
            'status',
            [
                'attribute'=>'created_at',
                'value' => function($data)
                {
                    return \Yii::$app->formatter->asDatetime($data['created_at'], 'dd/MM/yyyy HH:mm');
                },
                'format'=> 'html',
            ],
            [
                'attribute'=>'updated_at',
                'value' => function($data)
                {
                    return \Yii::$app->formatter->asDatetime($data['updated_at'], 'dd/MM/yyyy HH:mm');
                },
                'format'=> 'html',
            ],
        ],
    ]) ?>

    <h2>Влияющие факторы</h2>
    <p>
        <?= Html::a('Добавить фактор', ['/calc-factor/create', 'calc_id' => $model->id], ['class' => 'btn btn-success']) ?>

    </p>


    <?php
    // вид сессии - дата во вьюху
    $query = \common\models\CalcFactor::find()->where(['calc_id'=>$model->id]);
    $calcFactorDataProvider = new \yii\data\ActiveDataProvider([
        'query'=>$query,
    ]);
    ?>


    <?php
    echo yii\grid\GridView::widget([
        'dataProvider' => $calcFactorDataProvider,
        'emptyText' => '',
        'columns'=>[
            'group',
            'fl_code',
            'name',
            'math_sign',
            'value',
            [
                'class' => \yii\grid\ActionColumn::class,
                'buttons' => [
                    'update'=>function($url,$model){
                        $newUrl = Yii::$app->getUrlManager()->createUrl(['/calc-factor/update','id'=>$model['id']]);
                        return \yii\helpers\Html::a( '<span class="glyphicon glyphicon-pencil"></span>', $newUrl,
                            ['title' => Yii::t('yii', 'Обновить'), 'data-pjax' => '0','data-method'=>'post']);
                    },
                    'delete'=>function($url,$model){
                        $newUrl = Yii::$app->getUrlManager()->createUrl(['/calc-factor/delete','id'=>$model['id']]);
                        return \yii\helpers\Html::a( '<span class="glyphicon glyphicon-trash"></span>', $newUrl,
                            ['title' => Yii::t('yii', 'Удалить'), 'data-pjax' => '0','data-method'=>'post']);
                    },
                    'view'=>function($url,$model){
                        return false;
                    },


                ]
            ],
        ],
    ]);
    ?>

    <?= \common\widgets\MainBgCalculatorWidget::widget([
        'calc_code' => $model->fl_code,
    ]) ?>

</div>

