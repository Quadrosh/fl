<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\ArticleSectionBlockSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Article Section Blocks';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-section-block-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Article Section Block', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'article_section_id',
            'header',
            'header_class',
            'description:ntext',
            // 'raw_text:ntext',
            // 'image:ntext',
            // 'image_alt',
            // 'background_image:ntext',
            // 'thumbnail_image:ntext',
            // 'call2action_description',
            // 'call2action_name',
            // 'call2action_link',
            // 'call2action_class',
            // 'call2action_comment',
            // 'view',
            // 'color_key',
            // 'structure',
            // 'accent',
            // 'custom_class',
            // 'created_at',
            // 'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
