<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Calc */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="calc-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-sm-4">
            <?= $form->field($model, 'status')->dropDownList([
                'active' => 'active',
                'disabled' => 'disabled',
            ]) ?>
        </div>
        <div class="col-sm-4">
            <?= $form->field($model, 'fl_code')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-4">
            <?= $form->field($model, 'interest_rate')->textInput() ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'bank_id')
                ->dropDownList(\yii\helpers\ArrayHelper::map(
                    \common\models\Bank::find()->all(), 'id','name'),[
                    'options'=>[Yii::$app->request->get('bank_id')=>["Selected"=>true]],
                    'prompt'=>'выбери банк'
                ]) ?>
        </div>

        <div class="col-sm-12">
            <?= $form->field($model, 'description')->textarea(['rows' => 2]) ?>
        </div>
        <div class="col-sm-6"></div>
    </div>






    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
