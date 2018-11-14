<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\CalcFactor */

$this->title = 'Update Calc Factor: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Calc Factors', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="calc-factor-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
