<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Preorders */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Preorders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="preorders-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Точно удалить?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'ip',
            'site',
            'service_type',
            'operation_id',
            'platform',
            'inn',
            'name',
            'phone',
            'email:email',
            'text:ntext',
            'from_page',
            'utm_source',
            'utm_medium',
            'utm_campaign',
            'utm_term',
            'utm_content',
            'manager',
            'quality',
            'comment',
//            'date',
            [
                'attribute'=>'date',
                'value' => function($data)
                {
                    return \Yii::$app->formatter->asDatetime($data['date'], 'HH:mm dd/MM/yy');
                },
                'format'=> 'html',
            ],
            'done',
        ],
    ]) ?>

</div>
