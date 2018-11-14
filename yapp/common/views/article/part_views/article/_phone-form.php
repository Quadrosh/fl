<?php

use yii\helpers\Html;

$preorder = new \common\models\Preorders();


?>
<div class="phone-form">
    <?php $form = yii\bootstrap\ActiveForm::begin([
        'id' => 'quickorder-form-section'.$section->id,
        'method' => 'post',
        'action' => ['/site/order'],
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{beginWrapper}\n{input}\n{error}\n{endWrapper}",
            'horizontalCssClasses' => [
                'offset' => 'col-sm-offset-3 col-lg-offset-4',
                'wrapper' => 'col-sm-6 col-lg-4 xsQuickForm',
            ],
        ],
    ]); ?>

    <?= Html::errorSummary($preorder, ['class' => 'errors']) ?>

    <?= $form->field($preorder, 'phone', [
        'inputOptions' => [
            'placeholder' => 'ТЕЛЕФОН'
        ],
        'inputTemplate' => '<div class="input-group">{input}<span class="input-group-btn">'.
            '<button type="submit" class="btn btn-danger">Получить консультацию</button></span></div>',
    ])->textInput(['maxlength' => true, 'id' => 'quickorder-form-section'.$section->id.'-phone'])->label(false) ?>

    <?= $form->field($preorder, 'service_type',['template' => '{input}', 'options' => ['tag' => false]])
        ->hiddenInput(['value'=>\common\models\Preorders::SERVICE_TYPE_BG,
            'id' => 'quickorder-form-section'.$section->id.'-name'])->label(false) ?>

    <?= $form->field($preorder, 'name',['template' => '{input}', 'options' => ['tag' => false]])
        ->hiddenInput(['value'=>'Noname from short form',
            'id' => 'quickorder-form-section'.$section->id.'-name'])->label(false) ?>
    <?= $form->field($preorder, 'utm_source',['template' => '{input}', 'options' => ['tag' => false]])
        ->hiddenInput(['value'=>isset($utm['source'])?$utm['source']:null,
            'id' => 'quickorder-form-section'.$section->id.'-utm_sourse'])->label(false) ?>
    <?= $form->field($preorder, 'utm_medium',['template'=>'{input}','options'=>['tag'=>false]])
        ->hiddenInput(['value'=>isset($utm['medium'])?$utm['medium']:null,
            'id' => 'quickorder-form-section'.$section->id.'-utm_medium'])->label(false) ?>
    <?= $form->field($preorder, 'utm_campaign',['template'=>'{input}','options'=>['tag'=>false]])
        ->hiddenInput(['value'=>isset($utm['campaign'])?$utm['campaign']:null,
            'id' => 'quickorder-form-section'.$section->id.'-utm_campaign'])->label(false) ?>
    <?= $form->field($preorder, 'utm_term',['template' => '{input}', 'options' => ['tag' => false]])
        ->hiddenInput(['value'=>isset($utm['term'])?$utm['term']:null,
            'id' => 'quickorder-form-section'.$section->id.'-utm_term'])->label(false) ?>
    <?= $form->field($preorder, 'utm_content',['template' => '{input}', 'options' => ['tag' => false]])
        ->hiddenInput(['value'=>isset($utm['content'])?$utm['content']:null,
            'id' => 'quickorder-form-section'.$section->id.'-utm_content'])->label(false) ?>

    <?= $form->field($preorder, 'from_page',['template' => '{input}', 'options' => ['tag' => false]])
        ->hiddenInput(['value'=>$article ['hrurl'],
            'id' => 'quickorder-form-section'.$section->id.'-from_page'])->label(false) ?>
    <?php yii\bootstrap\ActiveForm::end(); ?>
</div>