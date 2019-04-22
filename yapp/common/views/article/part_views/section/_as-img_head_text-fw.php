<?php

use yii\helpers\Html;

?>


<section class="as-img_head_text fw <?= $model->color_key ?> <?= $model->custom_class ?>">
    <div class="row">
        <div class="  col-sm-12 pl0 pr0">
            <?php if ($model->section_image) {
                echo Html::img('/img/'.$model->section_image,[
                    'alt'=>$model->section_image_alt,
                    'title'=>$model->section_image_title?$model->section_image_title:null,
                ]);
            } ?>
            <?php if ($model->header) : ?>
                <h2 class="<?= $model->header_class ?>"><?= $model->header ?></h2>
            <?php endif; ?>

            <?php if ($model->description) : ?>
                <p class="text-left"><?= nl2br($model->description)  ?></p>
            <?php endif; ?>

            <?php if ($model->blocks) : ?>
                <div class="mt30 mb30">
                    <?php foreach ($model->blocks as $block) : ?>
                        <?php if ($block->view) : ?>
                            <?= $this->render('/article/part_views/block/'.$block->view, [
                                'model' => $block,
                                'article' => $article,
                                'utm' => isset($utm)?$utm:null,
                            ]) ?>
                        <?php endif; ?>
                        <?php if (!$block->view) : ?>
                            <?php if ($block->header) : ?>
                                <h3 class="<?= $block->header_class ?>"><?= $block->header ?></h3>
                            <?php endif; ?>
                            <?php if ($block->description) : ?>
                                <p class="text-center"><?= $block->description ?></p>
                            <?php endif; ?>
                            <?php if ($block->items) : ?>
                                <?php foreach ($block->items as $item) : ?>
                                    <?php if ($item->header) : ?>
                                        <h4 class="<?= $item->header_class ?>"><?= $item->header ?></h4>
                                    <?php endif; ?>
                                    <?php if ($item->description) : ?>
                                        <p class="text-center"><?= $item->description ?></p>
                                    <?php endif; ?>
                                    <?php if ($item->text) : ?>
                                        <p class="text-center"><?= $item->text ?></p>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <?php if ($model->raw_text) : ?>
                <p><?= nl2br($model->raw_text)  ?></p>
            <?php endif; ?>
            <?php if ($model->conclusion) : ?>
                <p <?= $model->conclusion_class?'class="'.$model->conclusion_class.'"':null ?>><?= nl2br($model->conclusion)  ?></p>
            <?php endif; ?>
        </div>
    </div>


</section>






