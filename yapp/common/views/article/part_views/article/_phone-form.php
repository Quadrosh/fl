<?php

use yii\helpers\Html;

$preorder = new \common\models\Preorders();


?>
<div class="phone-form ">
    <?php $form = yii\bootstrap\ActiveForm::begin([
        'id' => 'quickorder-form-section'.$section->id,
        'method' => 'post',
        'options' => [
            'class' => 'phoneForm_'.$article->service_type
        ],
        'action' => ['/site/order'],
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{beginWrapper}\n{input}\n{error}\n{endWrapper}",
            'horizontalCssClasses' => [
                'offset' => 'col-sm-offset-3 col-lg-offset-3',
                'wrapper' => 'col-sm-6 col-lg-6 xsQuickForm',
            ],
        ],
    ]); ?>

    <?= Html::errorSummary($preorder, ['class' => 'errors']) ?>

    <?= $form->field($preorder, 'phone', [
        'inputOptions' => [
            'placeholder' => 'ТЕЛЕФОН'
        ],
        'inputTemplate' => '<div class="input-group">{input}<span class="input-group-btn">'.
            '<button type="submit" class="btn btn-danger">'.$section->call2action_name.'</button></span></div>',
    ])->textInput(['maxlength' => true, 'id' => 'quickorder-form-section'.$section->id.'-phone'])
        ->label(false) ?>

    <?= $form->field($preorder, 'service_type',['template' => '{input}', 'options' => ['tag' => false]])
        ->hiddenInput(['value'=>$article->service_type,
            'id' => 'quickorder-form-section'.$section->id.'-name',
            'class'=>'form-control service_type_indicator',
        ])
        ->label(false) ?>

    <?= $form->field($preorder, 'name',['template' => '{input}', 'options' => ['tag' => false]])
        ->hiddenInput(['value'=>'-',
            'id' => 'quickorder-form-section'.$section->id.'-name'])
        ->label(false) ?>
    <?= $form->field($preorder, 'utm_source',['template' => '{input}', 'options' => ['tag' => false]])
        ->hiddenInput(['value'=>\common\models\Visit::getUtm('utm_source'),
            'id' => 'quickorder-form-section'.$section->id.'-utm_sourse'])
        ->label(false) ?>
    <?= $form->field($preorder, 'utm_medium',['template'=>'{input}','options'=>['tag'=>false]])
        ->hiddenInput(['value'=>\common\models\Visit::getUtm('utm_medium'),
            'id' => 'quickorder-form-section'.$section->id.'-utm_medium'])
        ->label(false) ?>
    <?= $form->field($preorder, 'utm_campaign',['template'=>'{input}','options'=>['tag'=>false]])
        ->hiddenInput(['value'=>\common\models\Visit::getUtm('utm_campaign'),
            'id' => 'quickorder-form-section'.$section->id.'-utm_campaign'])
        ->label(false) ?>

    <?= $form->field($preorder, 'utm_term',['template' => '{input}', 'options' => ['tag' => false]])
        ->hiddenInput(['value'=>\common\models\Visit::getUtm('utm_term'),
            'id' => 'quickorder-form-section'.$section->id.'-utm_term'])
        ->label(false) ?>

    <?= $form->field($preorder, 'utm_content',['template' => '{input}', 'options' => ['tag' => false]])
        ->hiddenInput(['value'=>\common\models\Visit::getUtm('utm_content'),
            'id' => 'quickorder-form-section'.$section->id.'-utm_content'])
        ->label(false) ?>

    <?= $form->field($preorder, 'from_page',['template' => '{input}', 'options' => ['tag' => false]])
        ->hiddenInput(['value'=>$article ['hrurl'],
            'id' => 'quickorder-form-section'.$section->id.'-from_page'])
        ->label(false) ?>
    <?php yii\bootstrap\ActiveForm::end(); ?>
</div>