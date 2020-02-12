<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ArticleSectionBlockItem */




?>
<div class="asbi-h_img_col-text_col <?= $model->custom_class ?>">

    <div class="table mb0">
        <?php if ($model->image) : ?>
            <div class="table-cell <?= $model->image_class ?> ">
                <?php if ($model->image) {
                    echo substr(trim($model->image), 0,4)!='<svg'?  Html::img('/img/'.$model->image,[
                        'alt'=>$model->image_alt,
                        'title'=>$model->image_title?$model->image_title:null,
                    ]):$model->image;
                } ?>
            </div>
        <?php endif; ?>
        <div class="table-cell pl10 vertical-middle">
            <?php if ($model->header) : ?>
                <h5 <?= $model->header_class?'class="'.$model->header_class.'"':null ?>><?= $model->header ?></h5>
            <?php endif; ?>
            <?php if ($model->description) : ?>
                <p <?= $model->description_class?'class="'.$model->description_class.'"':null ?>><?= $model->description ?></p>
            <?php endif; ?>

            <?php if ($model->text) : ?>
                <p <?= $model->text_class?'class="'.$model->text_class.'"':null ?>><?= $model->text ?></p>
            <?php endif; ?>

            <?php if ($model->link_name) : ?>
                <a href="<?= $model->link_url ?>" <?= $model->link_class?'class="'.$model->link_class.'"':null ?>><?= $model->link_name ?></a>
            <?php endif; ?>
            <?php if ($model->link_description) : ?>
                <p class="text-center"><?= $model->link_description ?></p>
            <?php endif; ?>
        </div>


        <?php if (strpos( $model->custom_class ,'nextArrow')!==false) : ?>
                <span class=" more768">
                    <svg version="1.1" class="arrow_r"
                         xmlns="http://www.w3.org/2000/svg"
                         xmlns:xlink="http://www.w3.org/1999/xlink"
                         x="0px" y="0px"
                         viewBox="0 0 20 70"
                         style="width: 20px;height: 70px; enable-background:new 0 0 20 70;"
                         xml:space="preserve">
                                <style type="text/css">
                                    .arrow_r_st0{fill:none;stroke:#6D6E71;stroke-width:2;stroke-linecap:round;stroke-miterlimit:10;}
                                </style>
                        <g >
                            <line  class="arrow_r_st0" x1="4.6" y1="4.7" x2="15.6" y2="35"/>
                            <line  class="arrow_r_st0" x1="15.6" y1="35" x2="4.6" y2="65.3"/>
                        </g>
                            </svg>
                </span>

                <span class="text-center less768">
                    <svg version="1.1" class="arrow_down"
                         xmlns="http://www.w3.org/2000/svg"
                         xmlns:xlink="http://www.w3.org/1999/xlink"
                         x="0px" y="0px"
                         viewBox="-514 141 70 20"
                         style="width: 70px;height: 20px;enable-background:new -514 141 70 20;"
                         xml:space="preserve">
                                <style type="text/css">
                                    .arrow_down_st0{fill:none;stroke:#6D6E71;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;}
                                </style>
                        <g>
                            <line class="arrow_down_st0" x1="-448.6" y1="145.5" x2="-478.9" y2="156.5"/>
                            <line class="arrow_down_st0" x1="-478.9" y1="156.5" x2="-509.2" y2="145.5"/>
                        </g>
                            </svg>
                </span>

        <?php endif; ?>


    </div>



</div>

