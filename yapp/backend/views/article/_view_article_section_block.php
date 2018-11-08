<h4><?= $model->header ?> <?= \yii\helpers\Html::a( '<span class="glyphicon glyphicon-pencil"></span>', '/article-section-block/update?id='.$model->id,
        [
            'title' => Yii::t('yii', 'Редактировать блок'),
            'data-confirm' =>'Точно редактировать?',
            'data-method'=>'post'
        ]); ?> <?= \yii\helpers\Html::a( '<span class="glyphicon glyphicon-plus"></span>', '/article-section-block-item/create?block_id='.$model->id,
        [
            'title' => Yii::t('yii', 'Добавить block item'),
            'data-method'=>'post'
        ]); ?></h4>
<?php if ($model->description) : ?>
    <i><?= nl2br($model->description) ?></i>
<?php endif; ?>
<?php if ($model->raw_text) : ?>
    <p><?= nl2br($model->raw_text) ?></p>
<?php endif; ?>

<ol class="breadcrumb">
    <li><a href="#">=s=> =b=> <?= $model->header ?></a></li>
    <li><a href="#">Blocks items</a></li>
</ol>

<?php
$query = \common\models\ArticleSectionBlockItem::find()
    ->where(['article_section_block_id'=>$model->id]);
$dataProvider = new \yii\data\ActiveDataProvider([
    'query'=>$query,
]);
echo \yii\widgets\ListView::widget([
    'dataProvider' => $dataProvider,
    'emptyText' => 'No Block Items',
    'itemView' => '_view_article_section_block_item',

]);
?>
