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
<div class="tz-calculator">




    <div  class="box light-grey ">

        <div class="row">

            <div id="tz_calc_box" class="col-sm-12" data-rate="<?= $calc->interest_rate ?>">

                <div class="value text-center">
                    Cумма займа <span id="current_val"></span> руб.
                </div>
                <div id="slider_container">
                    <div class="pin" id="slider_pin"></div>
                    <div class="slider_range"></div>
                </div>

                <div class="value text-center">
                    комиссия <span id="commission_val"></span> руб.
                </div>

            </div>



        </div>



    </div>

    <sup>
        <?= \common\models\Calc::INFO_MESSAGE ?>
    </sup>


</div>
