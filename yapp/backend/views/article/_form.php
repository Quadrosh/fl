<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use \common\models\Article;
use  \common\models\Preorders;

/* @var $this yii\web\View */
/* @var $model common\models\Article */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="article-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-sm-4">
            <?= $form->field($model, 'status')->dropDownList([
                Article::STATUS_PUBLISHED => Article::STATUS_PUBLISHED,
                Article::STATUS_DRAFT => Article::STATUS_DRAFT,
                Article::STATUS_PAGE => Article::STATUS_PAGE,
            ],['prompt' => 'Выбери статус']) ?>
        </div>
        <div class="col-sm-4">
            <?= $form->field($model, 'service_type')->dropDownList([
                Preorders::SERVICE_TYPE_BG =>  Preorders::SERVICE_TYPE_BG,
                Preorders::SERVICE_TYPE_TZ =>  Preorders::SERVICE_TYPE_TZ,
            ],['prompt' => 'Выбери вид услуги']) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'site')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\Sites::find()->all(), 'name','name'),['prompt'=>'Выберите сайт'])?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'categories')
                ->listBox(\yii\helpers\ArrayHelper::map(\common\models\Menu::find()
                    ->orderBy(['tree'=> SORT_ASC, 'lft'=> SORT_ASC])
                    ->all(),'id',function($model) {return str_repeat('-', $model->depth).$model['name'];}
                ),['prompt'=>'Выберите категорию','multiple' => true])
                ->label('Категория в каталоге') ?>
            <p>
                <?= Html::a('Создать категорию', ['/menu/create',
                    'url'=>$model->hrurl,
                    'name'=>$model->list_name], ['class' => 'btn btn-success btn-xs']) ?>
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
                '_a-article' => 'article',
                '_a-page_preorder_form' => 'page_preorder_form',
                '_a-page-topline_futorder' => 'page-topline_futorder',
                '_a-page_futorder' => 'page_futorder',
            ],['prompt' => 'Выбери вьюху']) ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'layout')->dropDownList([
                'article' => 'article',
                'article_datender' => 'article_datender',
                'article_no_footer' => 'article_no_footer',
            ],['prompt' => 'Выбери layout']) ?>
        </div>

    </div>






    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
