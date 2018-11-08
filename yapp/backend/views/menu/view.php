<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Menu */

$this->title = $model->name;
$tree = \common\models\Menu::find()->where(['id'=>$model->tree])->one();
$this->params['breadcrumbs'][] = ['label' => 'Menu', 'url' => ['index']];
if ($tree) {
    $this->params['breadcrumbs'][] = ['label' => $tree->name, 'url' => ['/menu/view?id='.$tree->id]];
}
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="menu-view">

    <?= common\widgets\MenuNestedSetsWidget::widget([
        'treeId'=>$model->tree,
        'formfactor'=>'backend',
        'currentItem'=> $model->id
    ]) ; ?>

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Точно удалить? Если это родитель, удалятся все дочерние элементы ('.count($model->children()->all()).')',
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a('Move Up', ['move', 'id' => $model->id, 'direction'=>'up'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Move Down', ['move', 'id' => $model->id, 'direction'=>'down'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Create Child', ['create', 'parent' => $model->id], ['class' => 'btn btn-warning']) ?>

    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'tree',
            'lft',
            'rgt',
            'depth',
            'name',
            'url:url',
            'description',
            [
                'attribute'=>'icon',
                'value' => function($data)
                {
                    return $data['icon'];
                },
                'format'=> 'raw',
            ],
            'icon:ntext',



        ],
    ]) ?>

</div>
