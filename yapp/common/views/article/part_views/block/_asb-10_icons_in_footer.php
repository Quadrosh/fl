<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ArticleSectionBlock */
/* @var $section common\models\ArticleSection */
/* @var $block common\models\ArticleSectionBlock */
/* @var $item common\models\ArticleSectionBlockItem */



?>
<div class="asb-10_icons_in_footer">

    <?php if ($model->header) : ?>
        <h3 <?= $model->header_class?'class="'.$model->header_class.'"':null ?>><?= $model->header ?></h3>
    <?php endif; ?>

    <?php if ($model->description) : ?>
        <p <?= $model->description_class?'class="'.$model->description_class.'"':null ?>><?= $model->description ?></p>
    <?php endif; ?>

    <?php if ($model->raw_text) : ?>
    <div class="col-sm-8 col-sm-offset-2 text-left">
        <p <?= $model->raw_text_class?'class="'.$model->raw_text_class.'"':null ?>><?= $model->raw_text ?></p>
    </div>
    <?php endif; ?>


    <?php if ($model->call2action_description) : ?>
        <p class="text-center mt50" ><?= nl2br($model->call2action_description)  ?></p>
    <?php endif; ?>
    <?php if ($model->call2action_name) : ?>
        <?php if ($model->call2action_link == 'callMe' || $model->call2action_link == 'call_me') : ?>
            <div class="col-sm-12 ">
                <?= $this->render('/article/part_views/article/_phone-form_wide', [
                    'section' => $model,
                    'article' => $article,

                ]) ?>

            </div>
        <?php  endif; ?>
        <?php if ($model->call2action_link != 'callMe' && $model->call2action_link != 'call_me') : ?>
            <?=
            Html::a( $model->call2action_name, [$model->call2action_link],['class'=>$model->call2action_class]);
            ?>
        <?php  endif; ?>
    <?php endif; ?>

    <?php if ($model->items) : ?>
        <div class="row mt50 more480">
            <div class="col-sm-1"></div>
            <?php $i=1; $count = count($model->items); foreach ( $model->items as $item)  : ?>

                <div class="col-sm-1 <?php
                    if ($i<7) {
                        echo 'col-xs-2';
                    } else {
                        echo 'more768';
                    }
                ?>">

                    <?php if ($item->view) : ?>
                        <?= $this->render('/article/part_views/block_item/'.$item->view, [
                            'model' => $item,
                        ]) ?>
                    <?php endif; ?>

                    <?php if (!$item->view) : ?>

                        <?php if ($item->image) : ?>
                            <?= Html::img('/img/'.$item->image,[
                                'class'=>'imgCenter '.$item->image_class,
                                'alt'=>$item->image_alt,
                            ])  ?>
                        <?php endif; ?>


                    <?php endif; ?>

                </div>
            <?php $i++; endforeach; ?>
        </div>

    <?php endif; ?>

    <?php if ($model->conclusion) : ?>
        <p <?= $model->conclusion_class?'class="'.$model->conclusion_class.'"':null ?>><?= nl2br($model->conclusion)  ?></p>
    <?php endif; ?>
</div>

