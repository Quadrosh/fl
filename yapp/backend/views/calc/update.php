<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Calc */

$this->title = 'Update Calc: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Calcs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="calc-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
