<?php
/* @var $model common\models\ArticleSection */
/* @var $block common\models\ArticleSectionBlock */
?>



<!--<h3>--><?//= $model->header ?><!-- --><?//= \yii\helpers\Html::a( '<span class="glyphicon glyphicon-pencil"></span>', '/article-section/update?id='.$model->id,
//        [
//            'title' => Yii::t('yii', 'Редактировать секцию'),
//            'data-confirm' =>'Точно редактировать?',
//            'data-method'=>'post'
//        ]); ?><!-- --><?//= \yii\helpers\Html::a( '<span class="glyphicon glyphicon-plus"></span>', '/article-section-block/create?section_id='.$model->id,
//        [
//            'title' => Yii::t('yii', 'Добавить блок'),
//            'data-method'=>'post'
//        ]); ?><!--</h3>-->
<?php //if ($model->description) : ?>
<!--    <i>--><?//= nl2br($model->description) ?><!--</i>-->
<?php //endif; ?>
<?php //if ($model->raw_text) : ?>
<!--    <p>--><?//= nl2br($model->raw_text) ?><!--</p>-->
<?php //endif; ?>

<?php if ($model->blocks) : ?>

<ol class="breadcrumb">
    <li><a href="#">=s=> <?= $model->header ?></a></li>
    <li><a href="#">Section Blocks</a></li>
</ol>


<?php
$query = \common\models\ArticleSectionBlock::find()
    ->where(['article_section_id'=>$model->id]);
$dataProvider = new \yii\data\ActiveDataProvider([
    'query'=>$query,
]);

echo \yii\widgets\ListView::widget([
    'dataProvider' => $dataProvider,
    'emptyText' => 'не найдено',
    'itemView' => '_view_article_section_block',

]);
?>
<?php endif; ?>