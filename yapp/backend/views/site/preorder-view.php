<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Preorders */

$this->title = 'Заявка #'. $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Заявки с UTM', 'url' => ['/site/stat']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="preorders-view">

    <h1><?= Html::encode($this->title) ?></h1>



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
