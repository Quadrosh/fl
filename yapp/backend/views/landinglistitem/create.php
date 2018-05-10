<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\LandingListitem */

$this->title = 'Create List Item';
$this->params['breadcrumbs'][] = ['label' => 'Landing Listitems', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="landing-listitem-create">

    <?php
    $section = \common\models\LandingSection::find()
        ->where(['id'=>Yii::$app->request->get('section_id')])
        ->one();
    $landingPage = $section->landingPage;
    ?>
    <h3><?= $landingPage['name'] . ' - ' . $section['section_type']?></h3>

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
