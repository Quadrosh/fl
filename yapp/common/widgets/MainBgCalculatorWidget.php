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
    public $data;
    public $view;
    public $only;


    public function init()
    {
        parent::init();

    }
    public function run()
    {


        if ($this->calc_code == 'bg_fun') {
            if ($this->view == 'rotor') {
                return $this->render('bg-fun-rotor-calculator', [
                    'bank' => $this->bank,
                    'calc_code' => $this->calc_code,
                    'data' => $this->data,
                    'only' => $this->only,
                ]);
            }
            else if ($this->view == 'vertical') {
                return $this->render('bg-fun-vertical-calculator', [
                    'bank' => $this->bank,
                    'calc_code' => $this->calc_code,
                    'data' => $this->data,
                ]);
            }
            else {
                return $this->render('bg-fun-calculator', [
                    'bank' => $this->bank,
                    'calc_code' => $this->calc_code,
                    'data' => $this->data,
                ]);
            }
        } else {
            return $this->render('main-bg-calculator', [
                'bank' => $this->bank,
                'calc_code' => $this->calc_code,
                'data' => $this->data,
            ]);
        }


    }


}