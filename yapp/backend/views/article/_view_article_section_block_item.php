<h5><?= $model->header ?> <?= \yii\helpers\Html::a( '<span class="glyphicon glyphicon-pencil"></span>', '/article-section-block-item/update?id='.$model->id,
        [
            'title' => Yii::t('yii', 'Редактировать блок'),
            'data-confirm' =>'Точно редактировать?',
            'data-method'=>'post'
        ]); ?> </h5>
<?php if ($model->description) : ?>
    <i><?= nl2br($model->description) ?></i>
<?php endif; ?>
<?php if ($model->text) : ?>
    <p><?= nl2br($model->text) ?></p>
<?php endif; ?>


