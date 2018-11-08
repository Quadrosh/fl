<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Article */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="article-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-sm-4">
            <?= $form->field($model, 'status')->dropDownList([
                'published' => 'published',
                'draft' => 'draft',
                'page' => 'page',
            ],['prompt' => 'Выбери статус']) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'site')->dropDownList(Yii::$app->params['siteList'],['prompt'=>'Выберите сайт'])?>
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
            <?= $form->field($model, 'list_name')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-12">
            <?= $form->field($model, 'hrurl')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-12">
            <?= Html::a('hrurl from listname', '#',[
                'text'=>$model->list_name,
                'id'=>'getHrurlFromArticleListname',
                'class'=>'btn btn-primary btn-xs',
                'data-model-id'=>$model->id,
            ]) ?>
        </div>


        <div class="col-sm-12">
            <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-12">
            <?= $form->field($model, 'description')->textarea(['rows' => 2]) ?>
        </div>
        <div class="col-sm-12">
            <?= $form->field($model, 'keywords')->textarea(['rows' => 1]) ?>
        </div>
        <div class="col-sm-12">
            <?= $form->field($model, 'exerpt')->textarea(['rows' => 2]) ?>
        </div>
        <div class="col-sm-12">
            <?= $form->field($model, 'exerpt_big')->textarea(['rows' => 2]) ?>
        </div>
        <div class="col-sm-12">
            <?= $form->field($model, 'h1')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-12">
            <?= $form->field($model, 'raw_text')->textarea(['rows' => 2]) ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'topimage')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'topimage_alt')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'background_image')->textarea(['rows' => 1]) ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'thumbnail_image')->textarea(['rows' => 1]) ?>
        </div>

        <div class="col-sm-4">
            <?= $form->field($model, 'call2action_name')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-4">
            <?= $form->field($model, 'call2action_link')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-4">
            <?= $form->field($model, 'call2action_class')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'call2action_description')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'call2action_comment')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'imagelink')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'imagelink_alt')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-12">
            <?= $form->field($model, 'author')->textInput(['maxlength' => true]) ?>
        </div>

        <div class="col-sm-6">
            <?= $form->field($model, 'view')->dropDownList([
                '_a-default' => 'default',
                '_a-page_preorder_form' => 'page_preorder_form',
                '_a-1' => '1',
            ],['prompt' => 'Выбери вьюху']) ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'layout')->textInput(['maxlength' => true]) ?>
        </div>

    </div>






    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
