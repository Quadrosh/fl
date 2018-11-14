<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\CalcFactor */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="calc-factor-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-sm-4">
            <?= $form->field($model, 'status')->dropDownList([
                'active' => 'active',
                'disabled' => 'disabled',
            ]) ?>
        </div>


        <div class="col-sm-2">
            <?= $form->field($model, 'value')->textInput() ?>
        </div>
        <div class="col-sm-2">
            <?= $form->field($model, 'math_sign')->textInput(['maxlength' => true,'value'=>'*']) ?>
        </div>
        <div class="col-sm-2">
            <?= $form->field($model, 'fl_code')->textInput() ?>
        </div>
        <div class="col-sm-2">
            <?= $form->field($model, 'group')->textInput() ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-8">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-4">
            <?= $form->field($model, 'calc_id')
                ->dropDownList(\yii\helpers\ArrayHelper::map(
                    \common\models\Calc::find()->all(), 'id','name'),[
                    'options'=>[Yii::$app->request->get('calc_id')=>["Selected"=>true]],
                    'prompt'=>'выбери калькулятор'
                ]) ?>
        </div>


        <div class="col-sm-12">
            <?= $form->field($model, 'description')->textarea(['rows' => 2]) ?>
        </div>
    </div>









    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
