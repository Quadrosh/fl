<?php

use yii\helpers\Html;
use \yii\widgets\ActiveForm;

$preorder = new \common\models\Preorders();


?>
<section id="mainOrderSection"
         class="<?= $article->call2action_class?$article->call2action_class:'dark' ?>">
    <div class="row">
        <div class="col-sm-12 text-center">
            <h2 class="head"><?= $article->call2action_description?$article->call2action_description:null ?></h2>
        </div>

        <div class="col-md-8 col-md-offset-2">

            <?php $form = ActiveForm::begin([
                'action' =>['site/order'],
                'id' => 'mainOrderForm',
                'options' => [
                    'class' => 'mainOrderForm_'.$article->service_type
                ],
                'method' => 'post',]); ?>

            <?= $form->field($preorder, 'utm_source')->hiddenInput([
                'value'=>\common\models\Visit::getUtm('utm_source'), 'id' => 'mainOrderForm-utm_source'])
                ->label(false) ?>
            <?= $form->field($preorder, 'utm_medium')->hiddenInput([
                'value'=>\common\models\Visit::getUtm('utm_medium'), 'id' => 'mainOrderForm-utm_medium'])
                ->label(false) ?>
            <?= $form->field($preorder, 'utm_campaign')->hiddenInput([
                'value'=>\common\models\Visit::getUtm('utm_campaign'), 'id' => 'mainOrderForm-utm_campaign'])
                ->label(false) ?>
            <?= $form->field($preorder, 'utm_term')->hiddenInput([
                'value'=>\common\models\Visit::getUtm('utm_term'), 'id' => 'mainOrderForm-utm_term'])
                ->label(false) ?>
            <?= $form->field($preorder, 'utm_content')->hiddenInput([
                'value'=>\common\models\Visit::getUtm('utm_content'), 'id' => 'mainOrderForm-utm_content'])
                ->label(false) ?>

            <?= $form->field($preorder, 'service_type')
                ->hiddenInput([
                        'value'=>$article->service_type,
                        'id' => 'quickorder_form_top-service_type',
                        'class'=>'form-control service_type_indicator',
                ])
                ->label(false) ?>
            <?= $form->field($preorder, 'site')
                ->hiddenInput(['value'=>'finlider.ru','id' => 'quickorder_form_top-site'])
                ->label(false) ?>
            <?= $form->field($preorder, 'from_page')
                ->hiddenInput(['value'=>$article->hrurl,'id' => 'quickorder_form_top-from_page'])
                ->label(false) ?>

            <div class="row">
                <div class="col-sm-6 col-sm-offset-3">
                    <?= $form->field($preorder, 'operation_id')
                        ->textInput(['required' => true,'id' => 'mainOrderForm-operation_id']) ?>
                </div>

            </div>

            <div class="row">
                <div class="col-sm-6">
                    <?= $form->field($preorder, 'inn')
                        ->textInput(['maxlength' => true, 'id' => 'quickorder_form_top-inn']) ?>
                </div>
                <div class="col-sm-6">
                    <?= $form->field($preorder, 'name')
                        ->textInput(['maxlength' => true, 'id' => 'quickorder_form_top-name']) ?>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <?= $form->field($preorder, 'phone')
                        ->textInput(['maxlength' => true, 'id' => 'quickorder_form_top-phone']) ?>
                </div>
                <div class="col-sm-6">
                    <?= $form->field($preorder, 'email')
                        ->textInput(['maxlength' => true, 'id' => 'quickorder_form_top-email']) ?>
                </div>
            </div>

            <div class="col-sm-12 text-center mt50">
                <?= Html::submitButton($article->call2action_name?$article->call2action_name:'Получить гарантию', ['class' => 'btn btn-danger']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>


    </div>


</section>