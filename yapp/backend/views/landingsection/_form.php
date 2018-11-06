<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\LandingSection */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="landing-section-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'page_id')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\LandingPage::find()->all(), 'id','name'),[ 'options'=>[Yii::$app->request->get('page_id')=>["Selected"=>true]]]) ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'order_num')->textInput() ?>
        </div>
        <div class="col-sm-12">
            <?= $form->field($model, 'head')->textarea(['rows' => 1 ,'maxlength' => true]) ?>

            <?= $form->field($model, 'lead')->textarea(['rows' => 1]) ?>

            <?= $form->field($model, 'text')->textarea(['rows' => 1]) ?>

            <?= $form->field($model, 'extra')->textarea(['rows' => 1]) ?>
        </div>
        <div class="col-sm-4">
            <?= $form->field($model, 'stylekey')->dropDownList([
                'dark' => 'Dark',
                'bright'=>'Bright',
                'grey'=>'Grey',
            ]) ?>
        </div>
        <div class="col-sm-4">
            <?= $form->field($model, 'image')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-4">
            <?= $form->field($model, 'image_alt')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'call2action_name')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'section_type')->dropDownList([
                'top' => 'top',
                'undertop' => 'undertop',
                'action_permanent'=>'action_permanent ("Extra" дней до конца)',
                'services'=>'services',
                'why_we'=>'why_we',
                'how_we_work'=>'how_we_work',
                'what_we_do'=>'what_we_do',
                'numbers'=>'numbers',
                'projects'=>'projects',
                'reviews'=>'reviews',
                'clients'=>'clients',
                'order_form'=>'order_form',
                'call2action'=>'call2action',
                'call2action2'=>'call2action2',
                'call2action3'=>'call2action3',
            ]); ?>
        </div>

    </div>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
