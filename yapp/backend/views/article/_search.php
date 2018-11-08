<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ArticleSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="article-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'list_name') ?>

    <?= $form->field($model, 'cat_ids') ?>

    <?= $form->field($model, 'hrurl') ?>

    <?= $form->field($model, 'title') ?>

    <?php // echo $form->field($model, 'description') ?>

    <?php // echo $form->field($model, 'keywords') ?>

    <?php // echo $form->field($model, 'exerpt') ?>

    <?php // echo $form->field($model, 'exerpt_big') ?>

    <?php // echo $form->field($model, 'h1') ?>

    <?php // echo $form->field($model, 'topimage') ?>

    <?php // echo $form->field($model, 'topimage_alt') ?>

    <?php // echo $form->field($model, 'background_image') ?>

    <?php // echo $form->field($model, 'thumbnail_image') ?>

    <?php // echo $form->field($model, 'call2action_description') ?>

    <?php // echo $form->field($model, 'call2action_name') ?>

    <?php // echo $form->field($model, 'call2action_link') ?>

    <?php // echo $form->field($model, 'call2action_class') ?>

    <?php // echo $form->field($model, 'call2action_comment') ?>

    <?php // echo $form->field($model, 'imagelink') ?>

    <?php // echo $form->field($model, 'imagelink_alt') ?>

    <?php // echo $form->field($model, 'author') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'view') ?>

    <?php // echo $form->field($model, 'layout') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'site') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
