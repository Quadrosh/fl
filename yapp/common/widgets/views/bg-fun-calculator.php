<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
//use yii\bootstrap\ActiveForm;

$calc =  \common\models\Calc::find()->where(['fl_code'=>$calc_code])->one();

$calcForm = new \common\models\CalculatorForm();

//$calcForm->factors = $calc->factors;

//$this->title = $name;

?>
<div class="bg-calculator">




    <div  class="box light-grey ">

        <div class="row">
<!--            <h1> %--><?//= $calc->interest_rate ?><!--</h1>-->


            <?php
            $factors = $calc->factors;
            $fz=[];
            $noFz=[];

            $i=0;
            ?>

            <div class="fz">
            <?php
            foreach ($factors as $factor) {
                if ($factor->group == 'fz') {
//                    echo Html::radio($factor->group,$factor->fl_code =='44fz',['value' =>$factor->name]);
                    $fz[strval($factor->value)] = $factor->name;
                } else {
                    $noFz[strval($factor->value)] = $factor->name;
                }
            }
            echo Html::radioList('fz', '1', $fz, [
                'class' => 'fz_list',
                'itemOptions' => ['class' => 'radio inline'],
            ]);

            ?>
            </div>

            <div id="bg_fun_calc_box" class="col-sm-12"
                 data-rate="<?= $calc->interest_rate ?>"
                 data-code=<?= $calc->fl_code  ?>
            >


                <div class="row">
                    <div class="col-sm-6">
                        <div class="value text-center">
                            Cумма гарантии<br> <span id="current_val"></span> руб.
                        </div>
                        <div id="slider_container">
                            <div class="pin" id="slider_pin"></div>
                            <div class="slider_range"></div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="value text-center">
                            Срок<br> <span id="time_val"></span> мес.
                        </div>
                        <div id="time_slider_container">
                            <div class="pin" id="time_slider_pin"></div>
                            <div class="time_slider_range"></div>
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-sm-12 mt30">
                        <?php
                        echo Html::checkboxList('noFz',null, $noFz, [
                            'class' => 'no_fz_list',
                        ]);
                        ?>
                    </div>
                </div>


                <div class="value text-center">
                    комиссия банка <span id="commission_val"></span> руб.
                </div>

            </div>



        </div>



    </div>

    <sup>
        <?= \common\models\Calc::INFO_MESSAGE ?>
    </sup>


</div>
