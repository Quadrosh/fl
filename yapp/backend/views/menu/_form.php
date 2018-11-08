<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Menu */
/* @var $form yii\widgets\ActiveForm */
if (isset($model->id)) {
    $parent = \common\models\Menu::find()
        ->where(['tree'=>$model->tree])
        ->andWhere('lft <='.$model->lft)
        ->andWhere('rgt >='.$model->rgt)
        ->andWhere(['depth'=>$model->depth-1])
        ->one();
} else {
    $parentFromGet = Yii::$app->request->get('parent');
    if ($parentFromGet) {
        $parent = \common\models\Menu::find()
            ->where(['id'=>$parentFromGet])
            ->one();
    } else {
        $parent = null;
    }
}
$trees = \common\models\Menu::find()
    ->select('tree')
    ->distinct()
    ->all();

?>

<!--<pre>--><?php //print_r($model->errors)?><!--</pre>-->



<?php if ($trees) {
    foreach ($trees as $tree) {
        echo common\widgets\MenuNestedSetsWidget::widget([
            'treeId'=>$tree->tree,
            'formfactor'=>'backend',
            'currentItem'=> $model?$model->id:0
        ]) ;
    }
} ?>

<div class="menu-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-sm-12">
            <?= $form->field($model, 'sub')
                ->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\Menu::find()
                    ->orderBy(['tree'=> SORT_ASC, 'lft'=> SORT_ASC])
                    ->all(),'id',function($model) {return str_repeat('-', $model->depth).$model['name'];}
                ),['prompt'=>'Создать новое меню','value'=>$parent?$parent->id:null])
                ->label('Родитель') ?>
        </div>
        <div class="col-sm-4">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

        </div>
        <div class="col-sm-8">
            <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>

        </div>
        <div class="col-sm-12">
            <?= $form->field($model, 'icon')->textarea(['rows'=>1]) ?>
        </div>
        <div class="col-sm-12">
            <?= $form->field($model, 'description')->textarea() ?>
        </div>
    </div>






    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
