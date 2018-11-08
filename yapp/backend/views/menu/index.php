<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\MenuSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Menu';
$this->params['breadcrumbs'][] = $this->title;

$trees = \common\models\Menu::find()
    ->select('tree')
    ->distinct()
    ->all();
?>

<div class="menu-index">

<!--    <pre>--><?php //print_r($trees) ?><!--</pre>-->

    <h1><?= Html::encode($this->title) ?></h1>


    <?php if ($trees) {
        foreach ($trees as $tree) {
            echo common\widgets\MenuNestedSetsWidget::widget([
                'treeId'=>$tree->tree,
                'formfactor'=>'backend',
                'currentItem'=> 0
            ]) ;
        }
    } ?>



    <p>
        <?= Html::a('Create', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'tree',
            'lft',
            'rgt',
            'depth',
            'name',
            'url:url',
            //'description',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
