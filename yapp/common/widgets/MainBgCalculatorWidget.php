<?php


namespace common\widgets;
//use common\models\City;
use common\models\Menu;
use yii\base\Widget;
use yii\helpers\ArrayHelper;


class MainBgCalculatorWidget extends Widget
{
    public $bank;
    public $calc_code;


    public function init()
    {
        parent::init();

    }
    public function run()
    {


        return $this->render('main-bg-calculator', [
            'bank' => $this->bank,
            'calc_code' => $this->calc_code,
        ]);

    }


}