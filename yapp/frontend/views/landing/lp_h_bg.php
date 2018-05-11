<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
//use \yii\widgets\ActiveForm;
use yii\bootstrap\ActiveForm;
//$this->title = 'Page View';
//$this->params['breadcrumbs'][] = $this->title;

$feedback = new common\models\Preorders();
$preorder = new common\models\Preorders();
?>

<?php
NavBar::begin([
    'brandLabel' => '<svg version="1.1"
            class="cpLogo"
            xmlns="http://www.w3.org/2000/svg"
            xmlns:xlink="http://www.w3.org/1999/xlink"
            x="0px" y="0px"
	        viewBox="0 0 1800 400"
	        style="enable-background:new 0 0 1800 400;"
	        xml:space="preserve">
<style type="text/css">
	.cpLogo_st0{fill:#58595B;}
</style>
<g >
	<rect  x="160.3" y="121.3" class="cpLogo_st0" width="58.5" height="175.5"/>
	<circle  class="cpLogo_st0" cx="188.3" cy="73.4" r="29.2"/>
	<rect  x="248" y="209.1" class="cpLogo_st0" width="58.5" height="87.7"/>
	<circle  class="cpLogo_st0" cx="277.9" cy="161" r="29.2"/>
	<rect  x="71.9" y="209.1" class="cpLogo_st0" width="58.5" height="87.7"/>
	<circle  class="cpLogo_st0" cx="101.8" cy="161" r="29.2"/>
</g>
<path  class="cpLogo_st0" d="M499.1,120.7h4.2c14.8,0.1,28.2,3.5,40.4,10.3c12.2,6.8,21.6,16.2,28.4,28.1
	c6.8,12,10.1,25.3,10.1,40.1c0,14.9-3.4,28.3-10.2,40.4c-6.8,12.1-16.2,21.5-28.2,28.3c-12,6.8-25.3,10.2-40,10.4h-4.7v26.3h-25
	v-26.3h-3.8c-15,0-28.5-3.4-40.8-10.2c-12.2-6.8-21.7-16.2-28.5-28.2c-6.8-12-10.1-25.5-10.1-40.4c0-14.9,3.4-28.4,10.1-40.4
	c6.8-12,16.2-21.4,28.5-28.2c12.2-6.8,25.8-10.2,40.8-10.2h3.8V93h25V120.7z M470.4,141c-16.8,0-30.1,5.2-39.9,15.5
	c-9.8,10.3-14.7,24.7-14.7,43c0,18.4,4.9,32.8,14.6,43c9.8,10.3,23.2,15.4,40.3,15.4h3.5V141H470.4z M499.1,141v117h3.8
	c17.1,0,30.5-5.3,40.1-15.8c9.6-10.5,14.4-24.8,14.4-42.9c0-17.9-4.8-32.1-14.4-42.6c-9.6-10.5-23.2-15.7-40.6-15.7H499.1z"/>
<path  class="cpLogo_st0" d="M704.8,151.3h24.8v145.3h-24.8V190.7l-67,105.9H613V151.3h24.8v106.1L704.8,151.3z"/>
<path  class="cpLogo_st0" d="M888.2,296.6h-24.8v-62h-66.7v62h-25V151.3h25v63h66.7v-63h24.8V296.6z"/>
<path  class="cpLogo_st0" d="M1201.5,151.3h24.8v145.3h-24.8V190.7l-67,105.9h-24.8V151.3h24.8v106.1L1201.5,151.3z"/>
<path  class="cpLogo_st0" d="M1265,276.3l8.6-10.6c9.7-12.5,15.2-31.3,16.5-56.4l2.3-58h93.6v125h18.7v63h-24.8v-42.7
	h-101.4v42.7h-24.8l0.1-63H1265z M1294.4,276.3h66.7V174.3h-44.7l-1.5,34.6C1313.5,237.8,1306.6,260.3,1294.4,276.3z"/>
<path  class="cpLogo_st0" d="M1492.5,299.3c-19.7,0-35.7-6.5-48.1-19.4c-12.4-12.9-18.5-30.2-18.5-51.9v-4.6
	c0-14.4,2.8-27.3,8.3-38.6c5.5-11.3,13.2-20.2,23.1-26.6c9.9-6.4,20.6-9.6,32.2-9.6c18.9,0,33.6,6.2,44,18.7
	c10.5,12.4,15.7,30.3,15.7,53.4v10.3h-98.4c0.4,14.3,4.5,25.9,12.6,34.7c8,8.8,18.2,13.2,30.5,13.2c8.8,0,16.2-1.8,22.3-5.4
	c6.1-3.6,11.4-8.3,16-14.2l15.2,11.8C1535.1,289.9,1516.8,299.3,1492.5,299.3z M1489.4,169c-10,0-18.4,3.6-25.2,10.9
	c-6.8,7.3-11,17.5-12.6,30.7h72.8v-1.9c-0.7-12.6-4.1-22.4-10.2-29.3C1508,172.5,1499.8,169,1489.4,169z"/>
<path  class="cpLogo_st0" d="M1700.6,225.6c0,22.1-5.1,39.9-15.2,53.4c-10.1,13.5-23.8,20.3-41.1,20.3
	c-17.6,0-31.5-5.6-41.6-16.8v70h-24.8V151.3h22.7l1.2,16.1c10.1-12.5,24.2-18.8,42.2-18.8c17.5,0,31.3,6.6,41.4,19.7
	c10.2,13.2,15.2,31.5,15.2,54.9V225.6z M1675.8,222.8c0-16.4-3.5-29.3-10.5-38.8c-7-9.5-16.6-14.2-28.7-14.2c-15,0-26.3,6.7-33.8,20
	v69.4c7.4,13.2,18.8,19.9,34.1,19.9c11.9,0,21.4-4.7,28.4-14.2C1672.3,255.4,1675.8,241.4,1675.8,222.8z"/>
<path  class="cpLogo_st0" d="M999,132.9c19.9,54.6,39.7,109.1,59.6,163.7h26.5l-74.8-195.5h-22.6l-74.7,195.5h26.6
	C959.5,242,979.2,187.5,999,132.9z"/>
</svg><span>Тендерное кредитование</span>',
    'brandUrl' => Yii::$app->homeUrl,
    'options' => [
        'class' => 'navbar navbar-fixed-top',
    ],
]);
echo Nav::widget([
    'options' => ['class' => 'navbar-nav navbar-right'],
    'encodeLabels' => false,
    'items' => [
        [
            'label' => 'Главная',
            'url' => ['/'],
        ],
        [
            'label' => 'Тендерный займ',
            'url' => ['/tender_zaim'],
        ],
        [
            'label' => 'Банковская гарантия',
            'url' => ['/bank_garant'],
            'active' => true
        ],
        [
            'label' => 'Контакты',
            'url' => ['/contacts'],
        ],
        [
            'label' => '<svg version="1.1"
                                 class="phone_icon"
                                 xmlns="http://www.w3.org/2000/svg"
                                 xmlns:xlink="http://www.w3.org/1999/xlink"
                                 x="0px" y="0px"
                                 viewBox="0 0 16.2 14.6"
                                 style="enable-background:new 0 0 16.2 14.6;"
                                 xml:space="preserve">
                        <style type="text/css">
                            .phone_icon_st0{fill:#414042;}
                        </style>
                                <g >
                                    <path  class="phone_icon_st0" d="M13.7,12.5c0,0-0.9,0.9-2.2,1.1c0,0-2.7-1.6-3.4-2c-0.7-0.4-2.9-2.4-4.2-4.3S1.9,4,1.9,4
		S1.8,2.7,2.9,1.7l2.4,3.5c0,0-0.4,0.7,0,1.2c0.4,0.5,3.9,3.9,3.9,3.9s0.5,0.2,1-0.1L13.7,12.5z"/>
                                    <path  class="phone_icon_st0" d="M6,4.6L5.6,4.9L3.2,1.5l0.5-0.3C3.8,1,4,1.1,4.1,1.2l2,2.9C6.2,4.3,6.2,4.5,6,4.6z"/>
                                    <path  class="phone_icon_st0" d="M14.2,11.7l-0.3,0.5l-3.6-2.3l0.3-0.5c0.1-0.2,0.3-0.2,0.5-0.1l3,1.9
		C14.2,11.3,14.3,11.5,14.2,11.7z"/>
                                </g>
                        </svg><span class="phone_num">'.Yii::$app->params['mainPhone'].'</span>',
            'url' => ['/contacts'],
        ],


    ],
]);
NavBar::end();
?>










<div class="container noHome bankGarant">


    <!--   bright top-->
    <section id="tzTopSection"
             class="<?= $sections['top']['stylekey'] ?> <?= $sections['top']['section_type'] ?>"
             >

        <?= common\widgets\Alert::widget() ?>
        <div class="row">

            <div class="col-sm-12 text-center noGP">
                <h1 class="head c_def"><span class="icon"><svg version="1.1" id="bank_ganrantee_svg_sm"
                                                               xmlns="http://www.w3.org/2000/svg"
                                                               xmlns:xlink="http://www.w3.org/1999/xlink"
                                                               x="0px" y="0px"
                                                               viewBox="0 0 85 70"
                                                               style="enable-background:new 0 0 85 70;"
                                                               xml:space="preserve">
<style type="text/css">
    .bank_ganrantee_svg_sm_st0{fill:#FFFFFF;}
</style>
                            <path class="bank_ganrantee_svg_sm_st0" d="M65.4,25.9H7.7v-3.2L36.6,6.4l28.8,16.3V25.9z M8.7,24.9h55.7v-1.6L36.6,7.5L8.7,23.2V24.9z
	 M36.6,22.5c-2.6,0-4.7-2.1-4.7-4.7s2.1-4.7,4.7-4.7s4.7,2.1,4.7,4.7S39.2,22.5,36.6,22.5z M36.6,14.1c-2,0-3.7,1.7-3.7,3.7
	s1.7,3.7,3.7,3.7s3.7-1.7,3.7-3.7S38.6,14.1,36.6,14.1z"/>
                            <g id="XMLID_451_">
                                <path class="bank_ganrantee_svg_sm_st0" d="M65.3,63.6c-0.1,0-0.3,0-0.4-0.1c-11.1-3.8-11.3-14.1-11.5-22.4l0-1.3l1.3,0
		c0,0,1.1,0,2.2-0.6c0.9-0.6,1.5-1.6,1.7-2.9l0.1-0.8l0.8-0.2c3.6-0.7,7.8-0.7,11.9,0l0.9,0.1l0.1,0.9c0.2,1.3,0.7,2.3,1.7,2.9
		c1,0.6,2.1,0.6,2.2,0.6l1.2,0l0,1.2c-0.2,8.3-0.5,18.7-11.5,22.4C65.6,63.6,65.4,63.6,65.3,63.6C65.3,63.6,65.3,63.6,65.3,63.6z
		 M55.7,42.2c0.3,9,1.4,16.1,9.5,19c8.2-3,9.3-9.8,9.5-19c-0.5-0.1-1-0.3-1.6-0.5c-0.1,0-0.1,0-0.2-0.1l0,0l-0.2-0.1c0,0,0,0,0,0
		c0,0,0,0,0,0l-0.4-0.3l0,0c-0.9-0.6-1.9-1.7-2.3-3.5c-3.3-0.5-6.5-0.5-9.5,0c-0.5,2-1.6,3.1-2.6,3.7C57.2,41.8,56.4,42,55.7,42.2z"
                                />
                                <path class="bank_ganrantee_svg_sm_st0" d="M65.3,37.8v22.5c0,0-7.4-2.4-8.3-11.1h16.6c0,0,0.6-3.3,0.5-6.5c0,0-4.2-1.3-4.5-4.5
		C69.5,38.2,67.2,37.7,65.3,37.8z"/>
                            </g>
                            <g>
                                <path class="bank_ganrantee_svg_sm_st0" d="M61.3,62.6H8.9v-3.9h5.7V29.6H8.9v-1.4h55.3v1.4h-6.3v7c0.1-0.2,0.1-0.5,0.2-0.7l0.1-0.9
		l0.7-0.1v-4.3h6.3v-3.4H7.9v3.4h5.7v27.1H7.9v5.9h55.3C62.5,63.3,61.9,62.9,61.3,62.6z"/>
                                <path class="bank_ganrantee_svg_sm_st0" d="M32.4,58.7V29.6H23v29.1H32.4z M24,30.6h7.4v27.1H24V30.6z"/>
                                <path class="bank_ganrantee_svg_sm_st0" d="M49.5,58.7V29.6h-8.8v29.1H49.5z M41.8,30.6h6.8v27.1h-6.8V30.6z"/>
                            </g>
</svg></span><?= $sections['top']['head'] ?></h1>
            </div>
            <div class="col-sm-12 text-center">
                <h2 class="lead c_def"><?= nl2br($sections['top']['lead']) ?></h2>
            </div>
            <div class="row">
                <div class="col-xs-10 col-xs-offset-1 col-sm-6 col-sm-offset-3 text-left alert_box">
                    <div class="col-xs-2">
                        <svg version="1.1" id="attention_sign"
                             xmlns="http://www.w3.org/2000/svg"
                             xmlns:xlink="http://www.w3.org/1999/xlink"
                             x="0px" y="0px"
                             viewBox="0 0 30 90"
                             style="enable-background:new 0 0 30 90;"
                             xml:space="preserve">
                            <style type="text/css">
                                .attention_sign_st0{fill:#A7A9AC;}
                            </style>
                            <g >
                                <path  class="attention_sign_st0" d="M9.7,83.9c-1.5-1.4-2.2-3.2-2.2-5.3s0.7-3.9,2.2-5.3c1.5-1.4,3.3-2.2,5.5-2.2
        c2.2,0,4,0.7,5.3,2.2c1.4,1.4,2.1,3.2,2.1,5.3s-0.7,3.9-2.2,5.3C19,85.3,17.3,86,15.2,86C13,86,11.2,85.3,9.7,83.9z M8.6,4h13.1
        l-2.2,55.7h-8.8L8.6,4z"/>
                            </g>
                        </svg>
                    </div>
                    <div class="col-xs-10">
                        <p><?= nl2br($sections['top']['extra']) ?></p>
                    </div>

                </div>
            </div>
            <div class="col-sm-8 col-sm-offset-2 text-left">
                <p><?= nl2br($sections['top']['text']) ?></p>
            </div>

        </div>
        <div class="row mt50 more480">
            <div class="col-sm-1">
            </div>
<!--            --><?php //foreach ($sections['top']['list_items'] as $listItem ) : ?>
<!--                <div class="col-sm-1">-->
<!--                    --><?//= Html::img('img/'.$listItem['image'],['class'=>'bankLogo']) ?>
<!--                </div>-->
<!--            --><?php //endforeach; ?>

            <div class="col-sm-1 col-xs-2">
                <?= Html::img('img/'.$sections['top']['list_items'][0]['image'],['class'=>'bankLogo']) ?>
            </div>
            <div class="col-sm-1 col-xs-2">
                <?= Html::img('img/'.$sections['top']['list_items'][1]['image'],['class'=>'bankLogo']) ?>
            </div>
            <div class="col-sm-1 col-xs-2">
                <?= Html::img('img/'.$sections['top']['list_items'][2]['image'],['class'=>'bankLogo']) ?>
            </div>
            <div class="col-sm-1 col-xs-2">
                <?= Html::img('img/'.$sections['top']['list_items'][3]['image'],['class'=>'bankLogo']) ?>
            </div>
            <div class="col-sm-1 col-xs-2">
                <?= Html::img('img/'.$sections['top']['list_items'][4]['image'],['class'=>'bankLogo']) ?>
            </div>
            <div class="col-sm-1 col-xs-2">
                <?= Html::img('img/'.$sections['top']['list_items'][5]['image'],['class'=>'bankLogo']) ?>
            </div>
            <div class="col-sm-1 more768">
                <?= Html::img('img/'.$sections['top']['list_items'][6]['image'],['class'=>'bankLogo']) ?>
            </div>
            <div class="col-sm-1 more768">
                <?= Html::img('img/'.$sections['top']['list_items'][7]['image'],['class'=>'bankLogo']) ?>
            </div>
            <div class="col-sm-1 more768">
                <?= Html::img('img/'.$sections['top']['list_items'][8]['image'],['class'=>'bankLogo']) ?>
            </div>
            <div class="col-sm-1 more768">
                <?= Html::img('img/'.$sections['top']['list_items'][9]['image'],['class'=>'bankLogo']) ?>
            </div>




        </div>


    </section>



    <!-- how we work -->
    <section id="howWeWorkSection"
             class="<?= $sections['howWeWork']['stylekey'] ?> <?= $sections['howWeWork']['section_type'] ?>">

        <div class="that_simple">
            <div class="row">
                <div class="col-sm-12 text-center">
                    <h2 class="head"><?= $sections['howWeWork']['head'] ?></h2>
                </div>

                <div class="col-sm-4 text-left">
                    <div class="row">
                        <div class="col-xs-3 howWeWork_icon">
                            <?= $sections['howWeWork']['list_items'][0] ['image'] ?>
                        </div>
                        <div class="col-xs-9 howWeWork_head">
                            <?= $sections['howWeWork']['list_items'][0] ['head'] ?>
                        </div>

                        <div class="arrow_next_step more768">
                            <svg version="1.1" class="arrow_r"
                                 xmlns="http://www.w3.org/2000/svg"
                                 xmlns:xlink="http://www.w3.org/1999/xlink"
                                 x="0px" y="0px"
                                 viewBox="0 0 20 70"
                                 style="enable-background:new 0 0 20 70;"
                                 xml:space="preserve">
                            <style type="text/css">
                                .arrow_r_st0{fill:none;stroke:#6D6E71;stroke-width:2;stroke-linecap:round;stroke-miterlimit:10;}
                            </style>
                                <g >
                                    <line  class="arrow_r_st0" x1="4.6" y1="4.7" x2="15.6" y2="35"/>
                                    <line  class="arrow_r_st0" x1="15.6" y1="35" x2="4.6" y2="65.3"/>
                                </g>
                        </svg>
                        </div>

                    </div>
                    <div class="row text-center less768">
                        <svg version="1.1" class="arrow_down"
                             xmlns="http://www.w3.org/2000/svg"
                             xmlns:xlink="http://www.w3.org/1999/xlink"
                             x="0px" y="0px"
                             viewBox="-514 141 70 20"
                             style="enable-background:new -514 141 70 20;"
                             xml:space="preserve">
                        <style type="text/css">
                            .arrow_down_st0{fill:none;stroke:#6D6E71;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;}
                        </style>
                            <g>
                                <line class="arrow_down_st0" x1="-448.6" y1="145.5" x2="-478.9" y2="156.5"/>
                                <line class="arrow_down_st0" x1="-478.9" y1="156.5" x2="-509.2" y2="145.5"/>
                            </g>
                    </svg>
                    </div>
                </div>



                <div class="col-sm-4 text-left">
                    <div class="row">
                        <div class="col-xs-3 howWeWork_icon">
                            <?= $sections['howWeWork']['list_items'][1] ['image'] ?>
                        </div>
                        <div class="col-xs-9 howWeWork_head">
                            <?= $sections['howWeWork']['list_items'][1] ['head'] ?>
                        </div>

                        <div class="arrow_next_step more768">
                            <svg version="1.1" class="arrow_r"
                                 xmlns="http://www.w3.org/2000/svg"
                                 xmlns:xlink="http://www.w3.org/1999/xlink"
                                 x="0px" y="0px"
                                 viewBox="0 0 20 70"
                                 style="enable-background:new 0 0 20 70;"
                                 xml:space="preserve">
                            <style type="text/css">
                                .arrow_r_st0{fill:none;stroke:#6D6E71;stroke-width:2;stroke-linecap:round;stroke-miterlimit:10;}
                            </style>
                                <g >
                                    <line  class="arrow_r_st0" x1="4.6" y1="4.7" x2="15.6" y2="35"/>
                                    <line  class="arrow_r_st0" x1="15.6" y1="35" x2="4.6" y2="65.3"/>
                                </g>
                        </svg>
                        </div>

                    </div>
                    <div class="row text-center less768">
                        <svg version="1.1" class="arrow_down"
                             xmlns="http://www.w3.org/2000/svg"
                             xmlns:xlink="http://www.w3.org/1999/xlink"
                             x="0px" y="0px"
                             viewBox="-514 141 70 20"
                             style="enable-background:new -514 141 70 20;"
                             xml:space="preserve">
	<style type="text/css">
        .arrow_down_st0{fill:none;stroke:#6D6E71;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;}
    </style>
                            <g>
                                <line class="arrow_down_st0" x1="-448.6" y1="145.5" x2="-478.9" y2="156.5"/>
                                <line class="arrow_down_st0" x1="-478.9" y1="156.5" x2="-509.2" y2="145.5"/>
                            </g>
</svg>
                    </div>

                </div>



                <div class="col-sm-4 text-left">
                    <div class="row">
                        <div class="col-xs-3 howWeWork_icon">
                            <?= $sections['howWeWork']['list_items'][2] ['image'] ?>
                        </div>
                        <div class="col-xs-9 howWeWork_head">
                            <?= $sections['howWeWork']['list_items'][2] ['head'] ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="more_info">

            <!--  Подробнее -->
            <div class="row text-center less768">
                <h3>Подробнее:</h3>
            </div>

            <div class="row mt20">
                <div class="col-sm-8 col-sm-offset-2 text-left">

                    <div class="row">
                        <div class="col-xs-2 stepNumber text-right">1</div>
                        <div class="col-xs-10">
                            <h4 class="howWeWork_more_info_head"><?= $sections['howWeWork']['list_items'][3] ['head'] ?></h4>
                            <p><?= nl2br($sections['howWeWork']['list_items'][3] ['text']) ?></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt20">
                <div class="col-sm-8 col-sm-offset-2 text-left">

                    <div class="row">
                        <div class="col-xs-2 stepNumber text-right">2</div>
                        <div class="col-xs-10">
                            <h4 class="howWeWork_more_info_head"><?= $sections['howWeWork']['list_items'][4] ['head'] ?></h4>
                            <p><?= nl2br($sections['howWeWork']['list_items'][4] ['text']) ?></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt20">
                <div class="col-sm-8 col-sm-offset-2 text-left">

                    <div class="row">
                        <div class="col-xs-2 stepNumber text-right">3</div>
                        <div class="col-xs-10">
                            <h4 class="howWeWork_more_info_head"><?= $sections['howWeWork']['list_items'][5] ['head'] ?></h4>
                            <p><?= nl2br($sections['howWeWork']['list_items'][5] ['text']) ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </section>





    <!-- Почему мы -->
    <section id="whyWeSection"
             class="<?= $sections['whyWe']['stylekey'] ?> <?= $sections['whyWe']['section_type'] ?>">

        <div class="row">

            <div class="col-sm-10 col-sm-offset-2 mt50">
                <?php foreach ($sections['whyWe']['list_items'] as $listItem ) : ?>
                    <div class="row mt10 listItem">
                        <div class="col-xs-3  col-sm-2 text-center">
                            <div class="whyWe_icon">
                                <?= $listItem ['image'] ?>
                            </div>
                        </div>
                        <div class="col-xs-9 col-sm-8 less480noPl noPl c_def ">
                            <div class="whyWe_head">
                                <?= $listItem ['head'] ?>
                            </div>
                            <div class="whyWe_text">
                                <?= $listItem ['text'] ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

        </div>


    </section>


    <section id="mainOrderSection"
             class="<?= $sections['order']['stylekey'] ?> <?= $sections['order']['section_type'] ?>">
        <div class="row">
            <div class="col-sm-12 text-center">
                <h2 class="head"><?= $sections['order']['head'] ?></h2>
            </div>

            <div class="col-md-8 col-md-offset-2">

                <?php $form = ActiveForm::begin([
                    'action' =>['site/order'],
                    'id' => 'mainOrderForm',
                    'method' => 'post',]); ?>
                <?= $form->field($preorder, 'utm_source')->hiddenInput(['value'=>$utm['source'], 'id' => 'mainOrderForm-utm_source'])->label(false) ?>
                <?= $form->field($preorder, 'utm_medium')->hiddenInput(['value'=>$utm['medium'], 'id' => 'mainOrderForm-utm_medium'])->label(false) ?>
                <?= $form->field($preorder, 'utm_campaign')->hiddenInput(['value'=>$utm['campaign'], 'id' => 'mainOrderForm-utm_campaign'])->label(false) ?>
                <?= $form->field($preorder, 'utm_term')->hiddenInput(['value'=>$utm['term'], 'id' => 'mainOrderForm-utm_term'])->label(false) ?>
                <?= $form->field($preorder, 'utm_content')->hiddenInput(['value'=>$utm['content'], 'id' => 'mainOrderForm-utm_content'])->label(false) ?>

                <?= $form->field($preorder, 'service_type')
                    ->hiddenInput(['value'=>'tender_zaim','id' => 'quickorder_form_top-service_type'])->label(false) ?>
                <?= $form->field($preorder, 'site')
                    ->hiddenInput(['value'=>'finlider.ru','id' => 'quickorder_form_top-site'])->label(false) ?>
                <?= $form->field($preorder, 'from_page')
                    ->hiddenInput(['value'=>'tender_zaim','id' => 'quickorder_form_top-from_page'])->label(false) ?>

                <div class="row">
                    <div class="col-sm-6">
                        <?= $form->field($preorder, 'operation_id')
                            ->textInput(['required' => true,'id' => 'mainOrderForm-operation_id']) ?>
                    </div>
                    <div class="col-sm-6">
                        <?= $form->field($preorder, 'platform')
                            ->textInput(['required' => true,'id' => 'mainOrderForm-platform']) ?>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <?= $form->field($preorder, 'inn')
                            ->textInput(['maxlength' => true, 'id' => 'quickorder_form_top-inn']) ?>
                    </div>
                    <div class="col-sm-6">
                        <?= $form->field($preorder, 'name')
                            ->textInput(['maxlength' => true, 'id' => 'quickorder_form_top-name']) ?>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <?= $form->field($preorder, 'phone')
                            ->textInput(['maxlength' => true, 'id' => 'quickorder_form_top-phone']) ?>
                    </div>
                    <div class="col-sm-6">
                        <?= $form->field($preorder, 'email')
                            ->textInput(['maxlength' => true, 'id' => 'quickorder_form_top-email']) ?>
                    </div>
                </div>

                <div class="col-sm-12 text-center mt50">
                    <?= Html::submitButton('Получить гарантию', ['class' => 'btn btn-danger']) ?>
                </div>
                <?php ActiveForm::end(); ?>
            </div>








        </div>


    </section>



