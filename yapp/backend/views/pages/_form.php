<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Pages */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pages-form">
    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-sm-4"><?= $form->field($model, 'status')
                ->dropDownList([
                    'published' => 'published',
                    'draft' => 'draft',
                    'article' => 'article (by hrurl)',
                ],['prompt' => 'Выбери статус',
                    'value'=>Yii::$app->request->get('status')]) ?></div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'site')->dropDownList(
                \yii\helpers\ArrayHelper::map(\common\models\Sites::find()->all(), 'name','name')) ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'categories')
                ->listBox(\yii\helpers\ArrayHelper::map(\common\models\Menu::find()
                    ->orderBy(['tree'=> SORT_ASC, 'lft'=> SORT_ASC])
                    ->all(),'id',function($model) {return str_repeat('-', $model->depth).$model['name'];}
                ),['prompt'=>'Выберите категорию','multiple' => true])
                ->label('Категория в каталоге') ?>
            <p>
                <?= Html::a('Создать категорию', ['/menu/create'], ['class' => 'btn btn-success btn-xs']) ?>
            </p>
        </div>
        <div class="col-sm-12">
            <?= $form->field($model, 'hrurl')->textInput(['maxlength' => true,
                'value'=>Yii::$app->request->get('hrurl')]) ?>
        </div>
        <div class="col-sm-12"><?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?></div>

        <div class="col-sm-12"><?= $form->field($model, 'description')->textarea(['rows' => 1]) ?></div>


        <div class="col-sm-12"><?= $form->field($model, 'pagehead')->textInput(['maxlength' => true]) ?></div>

        <div class="col-sm-12"><?= $form->field($model, 'pagedescription')->textarea(['rows' => 1]) ?></div>

        <div class="col-sm-12"><?= $form->field($model, 'text')->textarea(['rows' => 2]) ?></div>
        <div class="col-sm-6"><?= $form->field($model, 'imagelink')->textInput(['maxlength' => true]) ?></div>
        <div class="col-sm-6"><?= $form->field($model, 'imagelink_alt')->textInput(['maxlength' => true]) ?></div>
        <div class="col-sm-4"><?= $form->field($model, 'sendtopage')->textInput(['maxlength' => true]) ?></div>
        <div class="col-sm-4"><?= $form->field($model, 'promolink')->textInput(['maxlength' => true]) ?></div>
        <div class="col-sm-4"><?= $form->field($model, 'promoname')->textInput(['maxlength' => true]) ?></div>
        <div class="col-sm-6"><?= $form->field($model, 'seo_logo')->textarea(['rows' => 1]) ?></div>
        <div class="col-sm-6"><?= $form->field($model, 'keywords')->textarea(['rows' => 1]) ?></div>

        <div class="col-sm-6"><?= $form->field($model, 'view')->textInput(['maxlength' => true]) ?></div>
        <div class="col-sm-6"><?= $form->field($model, 'layout')->textInput(['maxlength' => true]) ?></div>

        <div class="col-sm-12">
            <div class="form-group">
                <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
            </div>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>
