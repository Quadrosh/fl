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
$calcForm->factors = $calc->factors;

//$this->title = $name;

?>
<div class="main-bg-calculator">

    <div class="box light-grey ">
        <div class="price-form">
            <?php $form = ActiveForm::begin([
                'id'=>'mainBgCalculator',
                'action' => ['/article/calculator'],
                // send by js
            ]); ?>
            <div class="row">

                <?php
                $noGroupFactors = [];
                $fzFactors=[];
                $fz44FactorId = null;
                foreach ($calcForm['factors'] as $factor) {
                    if ($factor->group == 'fz') {
                        $fzFactors[] = $factor;
                        if ($factor->fl_code == '44fz') {
                            $fz44FactorId = $factor->id;
                        }
                    } else {
                        $noGroupFactors[] = $factor;
                    }
                }
                $calcForm->fz = $fz44FactorId;
                ?>
                <div class="col-sm-12">
                    <?php foreach ($fzFactors as $factor) : ?>
                        <div class="inline mr10">
                            <?= $form->field($calcForm, 'fz')
                                ->radio([
                                    'label'=>$factor->name,
                                    'value'=>$factor->id,
                                    'uncheck'=>null
                            ])
                            ?>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="col-sm-6">
                    <?= $form->field($calcForm, 'summ')
                        ->textInput()?>

                    <?= $form->field($calcForm, 'calcId')
                        ->hiddenInput(['value'=>$calc->id])->label(false)?>
                </div>
                <div class="col-sm-6">
                    <?= $form->field($calcForm, 'timeMonths')
                        ->textInput()?>
                </div>
                <div class="col-sm-12">
                    <?php foreach ($noGroupFactors as $factor) : ?>
                    <div class="inline mr10">
                        <?= $form->field($calcForm, 'factors['.$factor->id.']')
                            ->checkbox(['label'=>$factor->name])?>
                    </div>
                    <?php endforeach; ?>
                </div>




                <div class="col-sm-12 text-center mt10">
                    <?= Html::submitButton( 'Рассчитать', ['class' => 'btn btn-primary']) ?>
                </div>

            </div>


            <div class="row">
                <div class="col-sm-8 col-sm-offset-2 text-center mt20">
                    <p id="calculatorResult"></p>
                </div>
            </div>

            <?php ActiveForm::end(); ?>

        </div>
    </div>

    <sup>
        <?= \common\models\Calc::INFO_MESSAGE ?>
    </sup>


</div>
