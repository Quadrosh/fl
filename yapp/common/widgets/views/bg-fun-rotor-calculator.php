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

$sumMessage = $data['sumMessage']?$data['sumMessage']:'Сумма гарантии';
$timeMessage = $data['timeMessage']?$data['timeMessage']:'Срок';
$resultMessage = $data['resultMessage']?$data['resultMessage']:'Комиссия банка';
$infoMessage = $data['infoMessage']?$data['infoMessage']: \common\models\Calc::INFO_MESSAGE;


?>
<!-- bg-calculator -->
<div class=" bg-calc-rotor">

    <div  class="box dark ">

        <div class="row">

            <?php
            $factors = $calc->factors;
            $fz=[];
            $noFz=[];
            $fzKeyByCode =[];

            $i=0;
//            $only = false ;
            $onlyRate=null;
            ?>

            <div class="fz">
            <?php
            foreach ($factors as $factor) {
                if ($factor->group == 'fz') {
                    if (!$only) {
                        $fz[strval($factor->value)] = $factor->name;
                    } else {
                        if ($only==$factor->fl_code) {
                            $onlyRate = $factor->value;
                        }
                    }

                } else {
                    $noFz[strval($factor->value)] = $factor->name;
                }
            }
            if (!$only) {
                echo Html::radioList('fz', '1', $fz, [
                    'class' => 'fz_list',
                    'itemOptions' => ['class' => 'radio inline'],
                ]);
            }



            ?>
            </div>

            <div id="bg_rotor_calc_box" class="col-sm-12"
                 data-rate="<?= $calc->interest_rate ?>"
                 data-code="<?= $calc_code  ?>"
                 data-only="<?= $only  ?>"
                 data-only-rate="<?= $onlyRate  ?>"
            >


                <div class="row">
                    <div class="col-sm-4">
                        <div class="value text-center">
                            <span class="display"><span id="current_val"></span> руб.</span>
                        </div>
                        <div class="rotor_container  text-center">

                            <?= Html::img('/img/knob.png',['class'=>'rotor_knob','id'=>'summ_rotor_pin']) ?>

                        </div>
                        <div class="col-xs-12  text-center">
                            <div class="name">
                                <?= $sumMessage ?>
                            </div>
                        </div>
                    </div>
<!--                    mt30 -->

                    <div class="col-sm-4  col-sm-push-4">
                        <div class="value text-center">
                            <span class="display"><span id="time_val"></span> мес.</span>
                        </div>

                        <div class="rotor_container  text-center">

                            <?= Html::img('/img/knob.png',['class'=>'rotor_knob','id'=>'time_rotor_pin']) ?>
                        </div>
                        <div class="col-xs-12 text-center">
                            <div class="name">
                                <?= $timeMessage ?>
                            </div>

                        </div>
                    </div>

                    <div class="col-sm-4 col-sm-pull-4 ">
                        <?php
                        echo Html::checkboxList('noFz',null, $noFz, [
                            'class' => 'no_fz_list',
                        ]);
                        ?>
                    </div>



                </div>


                <div class="result-value text-center">
                    <span class="display"><?= $resultMessage ?> <span id="commission_val"></span> руб.</span>
                </div>

            </div>



        </div>



    </div>

    <sup>
        <?= $infoMessage ?>
    </sup>


</div>
