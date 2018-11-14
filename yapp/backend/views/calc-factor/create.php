<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\CalcFactor */

$this->title = 'Create Calc Factor';
$this->params['breadcrumbs'][] = ['label' => 'Calc Factors', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="calc-factor-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
