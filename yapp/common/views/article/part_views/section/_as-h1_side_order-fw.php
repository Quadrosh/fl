<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

?>


<section class="as-h1_side_order fw cover <?= $model->color_key ?> <?= $model->custom_class ?> "
    <?= $model->background_image_title?'title="'.$model->background_image_title.'"':null ?>
    <?= $model->background_image?'style=" background-image: url(/img/'.$model->background_image.'"':null ?>
>



    <div class="row">
        <div class="col-sm-9  text-block">
            <div class="col-sm-12">
                <?php if ($model->header) : ?>
                    <h1 <?= $model->header_class?'class="'.$model->header_class.'"':null ?>><?= nl2br($model->header) ?></h1>
                <?php endif; ?>
            </div>
            <div class="col-sm-12">
                <?php if ($model->description) : ?>
                    <p <?= $model->description_class?'class="'.$model->description_class.'"':null ?>><?= nl2br($model->description)  ?></p>
                <?php endif; ?>

                <?php if ($model->raw_text) : ?>
                    <p class="text <?= $model->raw_text_class ?>" ><?= nl2br($model->raw_text)  ?></p>
                <?php endif; ?>



                <?php if ($model->conclusion) : ?>
                    <p <?= $model->conclusion_class?'class="'.$model->conclusion_class.'"':null ?>><?= nl2br($model->conclusion)  ?></p>
                <?php endif; ?>

                <?php if ($model->call2action_description) : ?>
                    <p class="text-center mt50" ><?= nl2br($model->call2action_description)  ?></p>
                <?php endif; ?>
                <?php if ($model->call2action_name) : ?>
                    <?php if ($model->call2action_link == 'callMe' || $model->call2action_link == 'call_me') : ?>
                        <div class="col-md-10 col-md-offset-1  col-lg-8 col-lg-offset-2 ">
                            <?= $this->render('/article/part_views/article/_phone-form_wide', [
                                'article' => $article,
                            ]) ?>
                        </div>
                    <?php endif; ?>
                    <?php if ($model->call2action_link != 'callMe' && $model->call2action_link != 'call_me') : ?>
                        <?=
                        Html::a( $model->call2action_name, [$model->call2action_link],['class'=>$model->call2action_class]);
                        ?>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </div>
        <div id="divTopForm" class="col-sm-3 topForm dirty text-center">
            <?= $this->render('/article/part_views/article/_side-form', [
                'article' => $article,
            ]) ?>
        </div>
    </div>





</section>






