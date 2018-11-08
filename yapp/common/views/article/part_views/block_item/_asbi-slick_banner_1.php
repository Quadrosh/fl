<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ArticleSectionBlockItem */




?>
<div class="asb-img_link_description text-center">

    <?php if ($model->header) : ?>
        <p class="<?= $item->header_class ?>"><?= $model->header ?></p>
    <?php endif; ?>
    <?php if ($model->description) : ?>
        <p class="text-center"><?= $model->description ?></p>
    <?php endif; ?>
    <?php if ($model->image) : ?>
        <?= Html::img('/img/'.$model->image,['class'=>'w100'])  ?>
    <?php endif; ?>
    <?php if ($model->link_name) : ?>
        <a href="<?= $model->link_url ?>" class="<?= $model->link_class ?>"><?= $model->link_name ?></a>
    <?php endif; ?>
    <?php if ($model->link_description) : ?>
        <p class="text-center"><?= $model->link_description ?></p>
    <?php endif; ?>

</div>

