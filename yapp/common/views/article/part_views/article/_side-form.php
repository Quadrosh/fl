<?php

use yii\helpers\Html;
use \yii\widgets\ActiveForm;
use \common\models\Visit;

$preorder = new \common\models\Preorders();

$form = \yii\bootstrap\ActiveForm::begin([
    'id' => 'quickorder_form_top',
    'method' => 'post',
    'action' => ['/site/order'],

]);

?>

<?= Html::errorSummary($preorder, ['class' => 'errors']) ?>

<?= $form->field($preorder, 'operation_id')
    ->textInput(['maxlength' => true, 'id' => 'quickorder_form_top-operation_id'])
    ->label('№ процедуры и площадка') ?>

<?= $form->field($preorder, 'inn')
    ->textInput(['maxlength' => true, 'id' => 'quickorder_form_top-inn']) ?>

<?= $form->field($preorder, 'name')
    ->textInput(['maxlength' => true, 'id' => 'quickorder_form_top-name']) ?>

<?= $form->field($preorder, 'phone')
    ->textInput(['maxlength' => true, 'id' => 'quickorder_form_top-phone']) ?>

<?= $form->field($preorder, 'email')
    ->textInput(['maxlength' => true, 'id' => 'quickorder_form_top-email']) ?>


<?= $form->field($preorder, 'utm_source')
    ->hiddenInput(['value'=>Visit::getUtm('utm_source'), 'id' => 'quickorder_form_top-utm_source'])->label(false) ?>
<?= $form->field($preorder, 'utm_medium')
    ->hiddenInput(['value'=>Visit::getUtm('utm_medium'), 'id' => 'quickorder_form_top-utm_medium'])->label(false) ?>
<?= $form->field($preorder, 'utm_campaign')
    ->hiddenInput(['value'=>Visit::getUtm('utm_campaign'), 'id' => 'quickorder_form_top-utm_campaign'])->label(false) ?>
<?= $form->field($preorder, 'utm_term')
    ->hiddenInput(['value'=>Visit::getUtm('utm_term'), 'id' => 'quickorder_form_top-utm_term'])->label(false) ?>
<?= $form->field($preorder, 'utm_content')
    ->hiddenInput(['value'=>Visit::getUtm('utm_content'), 'id' => 'quickorder_form_top-utm_content'])->label(false) ?>

<?= $form->field($preorder, 'service_type')
    ->hiddenInput([
            'value'=>$article->service_type,
            'id' => 'quickorder_form_top-service_type',
            'class'=>'form-control service_type_indicator'
        ])->label(false) ?>
<?= $form->field($preorder, 'site')
    ->hiddenInput(['value'=>$article->site,'id' => 'quickorder_form_top-site'])->label(false) ?>
<?= $form->field($preorder, 'from_page')
    ->hiddenInput(['value'=>$article->hrurl,'id' => 'quickorder_form_top-from_page'])->label(false) ?>

    <div class="form-group">
        <?= Html::submitButton('Получить гарантию', ['class' => 'btn btn-danger']) ?>
    </div>
<?php  \yii\bootstrap\ActiveForm::end(); ?>