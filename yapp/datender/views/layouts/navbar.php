<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;

if (isset($onDark)) {
    $fill = '#ffffff';
    $phoneFill='#ffffff';
    $mottoClass = '';
    $nabarClass = 'navbar-inverse';
} else {
    $fill = '#58595B';
    $phoneFill='#414042';
    $mottoClass = 'onBright';
    $nabarClass = 'navbar relative';

}

NavBar::begin([
    'brandLabel' => '<svg version="1.1"
	id="datender_logo"
	xmlns="http://www.w3.org/2000/svg"
	xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
	viewBox="0 0 425.2 99.2"
	style="enable-background:new 0 0 425.2 99.2;"
	xml:space="preserve">
<style type="text/css">
	.datender_logo_st0{fill:#FB0034;}
</style>
<g>
	<path d="M179.8,41.7h-13.3V72h-8.9V41.7h-13.3v-7.5h35.5V41.7z"/>
	<path d="M219.9,55.9h-29.7c0.5,2.8,1.9,5,4.1,6.6c2.2,1.6,4.9,2.4,8.2,2.4c4.2,0,7.6-1.4,10.3-4.1l4.8,5.5c-1.7,2-3.9,3.6-6.5,4.6
		c-2.6,1-5.5,1.6-8.8,1.6c-4.2,0-7.8-0.8-11-2.5c-3.2-1.7-5.6-4-7.3-6.9c-1.7-3-2.6-6.3-2.6-10c0-3.7,0.8-7,2.5-10
		c1.7-3,4-5.3,7-6.9c3-1.7,6.3-2.5,10.1-2.5c3.7,0,7,0.8,9.9,2.4c2.9,1.6,5.2,3.9,6.8,6.9c1.6,3,2.4,6.4,2.4,10.3
		C220.1,53.9,220,54.8,219.9,55.9z M193.7,43.3c-2,1.7-3.2,3.9-3.6,6.7h21.5c-0.4-2.7-1.5-5-3.5-6.7c-1.9-1.7-4.4-2.6-7.2-2.6
		C198.1,40.8,195.7,41.6,193.7,43.3z"/>
	<path d="M229.8,34.1h8.9v15.4h19.1V34.1h8.9V72h-8.9v-15h-19.1v15h-8.9V34.1z"/>
	<path d="M319,64.5v16h-8.3V72h-29.2v8.4h-8.2v-16h1.8c2.4-0.1,4.1-1.6,4.9-4.6c0.9-3,1.5-7.2,1.7-12.7l0.5-13h31.2v30.4H319z
		 M288.7,58.4c-0.5,2.7-1.5,4.8-2.8,6.1h18.7V41.7H290l-0.2,6.1C289.6,52.1,289.2,55.7,288.7,58.4z"/>
	<path d="M362.3,55.9h-29.7c0.5,2.8,1.9,5,4.1,6.6s4.9,2.4,8.2,2.4c4.2,0,7.6-1.4,10.3-4.1l4.8,5.5c-1.7,2-3.9,3.6-6.5,4.6
		c-2.6,1-5.5,1.6-8.8,1.6c-4.2,0-7.8-0.8-11-2.5c-3.2-1.7-5.6-4-7.3-6.9c-1.7-3-2.6-6.3-2.6-10c0-3.7,0.8-7,2.5-10
		c1.7-3,4-5.3,7-6.9c3-1.7,6.3-2.5,10.1-2.5c3.7,0,7,0.8,9.9,2.4c2.9,1.6,5.2,3.9,6.8,6.9c1.6,3,2.4,6.4,2.4,10.3
		C362.4,53.9,362.4,54.8,362.3,55.9z M336.1,43.3c-2,1.7-3.2,3.9-3.6,6.7H354c-0.4-2.7-1.5-5-3.5-6.7c-1.9-1.7-4.4-2.6-7.2-2.6
		C340.4,40.8,338,41.6,336.1,43.3z"/>
	<path d="M403.1,36.1c2.9,1.6,5.2,3.9,6.8,6.8c1.7,2.9,2.5,6.3,2.5,10.1c0,3.8-0.8,7.2-2.5,10.2c-1.7,3-3.9,5.2-6.8,6.8
		c-2.9,1.6-6.2,2.4-9.9,2.4c-5.1,0-9.2-1.7-12.1-5.1v18.4h-8.9V34.1h8.4v5c1.5-1.8,3.3-3.1,5.4-4c2.2-0.9,4.5-1.3,7.1-1.3
		C396.9,33.7,400.2,34.5,403.1,36.1z M400.2,61.7c2.1-2.2,3.2-5,3.2-8.6c0-3.5-1.1-6.4-3.2-8.6c-2.1-2.2-4.8-3.3-8.1-3.3
		c-2.1,0-4,0.5-5.7,1.5c-1.7,1-3.1,2.4-4,4.2c-1,1.8-1.5,3.9-1.5,6.2c0,2.4,0.5,4.4,1.5,6.2c1,1.8,2.3,3.2,4,4.2
		c1.7,1,3.6,1.5,5.7,1.5C395.4,64.9,398.1,63.8,400.2,61.7z"/>
</g>
<g>
	<path class="datender_logo_st0" d="M36.2,71.9c-1.2,0-2.3,0-3.4,0.1c-1.1,0-2.2,0.2-3.2,0.4c-2,0.4-4.2,2-6.4,4.8c-2.2,2.8-3.7,5.7-4.6,8.6h-2.9
		V68.2h5.4c3.5-5.2,6.7-11.9,9.5-20c2.8-8.2,4.3-15.1,4.3-20.9c0-1.5-0.1-2.7-0.4-3.5c-0.3-0.8-0.9-1.5-1.9-2
		c-0.7-0.4-1.7-0.7-3.1-0.9c-1.4-0.2-2.5-0.4-3.2-0.4v-3h50.2v3c-0.8,0.1-1.7,0.2-2.8,0.3c-1,0.2-2,0.4-2.8,0.6
		c-1,0.3-1.6,0.9-2,1.6c-0.3,0.7-0.5,1.5-0.5,2.4v39.2c0,1.4,0.4,2.4,1.3,3c0.9,0.7,2.1,1,3.7,1h3.6v17.3h-2.9
		c-0.8-2.9-2.4-5.7-4.7-8.5c-2.3-2.8-4.4-4.4-6.3-4.8c-0.8-0.2-1.8-0.3-3.2-0.3c-1.4-0.1-2.5-0.1-3.4-0.1H36.2z M54.8,64.7V21.1
		H40.7c-0.3,7.8-1.6,16-4,24.5c-2.4,8.5-5.6,16-9.7,22.6h24.5c1.1,0,1.9-0.3,2.4-0.8C54.5,66.8,54.8,65.9,54.8,64.7z"/>
	<path class="datender_logo_st0" d="M141.2,72.1h-29.8v-3c1.4-0.1,3-0.4,4.9-0.8s2.8-0.9,2.8-1.5c0-0.2,0-0.4-0.1-0.7s-0.1-0.6-0.3-1l-4.7-11.3
		H95.2c-0.4,1.1-0.9,2.3-1.4,3.7c-0.5,1.4-1,2.7-1.4,3.8c-0.5,1.4-0.8,2.5-0.9,3.1c-0.1,0.6-0.1,1.1-0.1,1.3c0,0.8,0.6,1.5,1.9,2.1
		c1.2,0.6,3.3,1,6.2,1.3v3H77v-3c0.8-0.1,1.8-0.2,2.9-0.4c1.1-0.2,1.9-0.5,2.5-0.9c1.1-0.6,1.9-1.4,2.7-2.3c0.7-0.9,1.3-2,1.8-3.2
		c3-7.2,6-14.5,9-21.7c3-7.3,6.3-15.2,9.9-24h7.7c5,12.4,9,22.2,11.8,29.4c2.9,7.2,5.3,13.2,7.3,17.9c0.3,0.8,0.8,1.5,1.3,2.1
		c0.5,0.6,1.2,1.2,2.2,1.8c0.7,0.4,1.6,0.7,2.5,0.9c1,0.2,1.8,0.3,2.6,0.4V72.1z M112.5,50l-7.9-19.8L96.8,50H112.5z"/>
</g>
</svg><span class="navbar_motto '.$mottoClass.'">Тендерные услуги</span>',
    'brandUrl' => Yii::$app->homeUrl,
    'options' => [
        'class' => $nabarClass.' navbar-fixed-top mb0',
    ],
]);
echo Nav::widget([
    'options' => ['class' => 'navbar-nav navbar-right'],
    'encodeLabels' => false,
    'items' => [
        [
            'label' => 'Главная',
            'url' => Yii::$app->request->url == '/'?false:['/'],
            'active' => Yii::$app->request->url == '/'?true:false,
        ],
        [
            'label' => 'Тендерный займ',
            'url' => Yii::$app->request->url == '/tender_zaim'?false:['/tender_zaim'],
            'active' => Yii::$app->request->url == '/tender_zaim'?true:false,
        ],
        [
            'label' => 'Банковская гарантия',
            'url' => Yii::$app->request->url == '/bank_garant'?false:['/bank_garant'],
            'active' => Yii::$app->request->url == '/bank_garant'?true:false,

        ],
        [
            'label' => 'Контакты',
            'url' => Yii::$app->request->url == '/contacts'?false:['/contacts'],
            'active' => Yii::$app->request->url == '/contacts'?true:false,
        ],
        [
            'label' => '<svg version="1.1"
            class="phone_icon"
            xmlns="http://www.w3.org/2000/svg"
            xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
	        viewBox="0 0 200 200" style="enable-background:new 0 0 200 200;" xml:space="preserve">
	        <style type="text/css">
                            .phone_icon_st0{fill:'.$phoneFill.';}
            </style>
<g>
	<path class="phone_icon_st0" d="M110.7,66.3h13v-5.1c0-0.8-0.6-1.5-1.4-1.7c-1.6-0.3-4.9-0.6-11.5-1V66.3z"/>
	<path class="phone_icon_st0" d="M100,56C100,56,100,56,100,56c-12.4,0-24.4,1.2-35.7,3.4l1.6,6l0.7,2.8l0.1,0.3l0.1,0.5c-0.1,3-8.3,7.6-19.5,11
		c-1.5,0.5-3.1,0.9-4.7,1.4c-6.5,1.7-12.6,2.7-17.4,2.9c-5.2,0.3-8.9-0.4-9.8-1.9l-0.2-0.9l-0.7-2.8l-0.1-0.5l0,0l-3.9-15l0,0
		C24,54.1,41,46.9,60,42.7c12.6-2.8,26-4.3,40-4.3c0,0,0,0,0,0c14,0,27.5,1.5,40,4.3l0,0c19,4.2,36,11.3,49.6,20.6l0,0l-3.9,15l0,0
		l-0.1,0.5l-0.7,2.8l-0.2,0.9c-0.9,1.5-4.6,2.2-9.8,1.9c-4.8-0.2-10.9-1.2-17.4-2.9c-1.6-0.4-3.2-0.9-4.7-1.4
		c-11.3-3.5-19.4-8-19.5-11l0.1-0.5l0.1-0.3l0.7-2.8l1.6-6C124.4,57.2,112.4,56,100,56C100,56,100,56,100,56"/>
	<path class="phone_icon_st0" d="M89.3,58.5c-6.7,0.3-9.9,0.7-11.5,1c-0.8,0.1-1.4,0.9-1.4,1.7v5.1h13V58.5z"/>
	<polygon class="phone_icon_st0" points="25.2,146.5 31.8,163.1 168.2,163.1 174.8,146.5 	"/>
	<path class="phone_icon_st0" d="M153.5,82.6c-3.7-1.1-7.1-2.4-10.1-3.7c-5.1-2.3-9-4.7-10.9-7c-1-1.2-1.5-2.3-1.5-3.3H69c0.1,1-0.4,2.1-1.5,3.3
		c-2,2.3-5.9,4.8-10.9,7c-3,1.3-6.4,2.6-10.1,3.7l-21.3,61.8h149.6L153.5,82.6z M97,87.3h6l1.3,8h-8.5L97,87.3z M94.9,101.2h10.3
		l1.5,9.8H93.3L94.9,101.2z M84.1,132.3H65.4l3.7-15.5h17.5L84.1,132.3z M87.4,111h-17l2.3-9.8H89L87.4,111z M74.2,95.4l1.9-8h15
		l-1.3,8H74.2z M90,132.3l2.4-15.5h15.2l2.4,15.5H90z M108.9,87.3h15l1.9,8h-15.7L108.9,87.3z M111,101.2h16.2l2.3,9.8h-17
		L111,101.2z M115.9,132.3l-2.4-15.5h17.5l3.7,15.5H115.9z"/>
</g>
</svg><span class="phone_num">'.Yii::$app->params['mainPhone'].'</span>',
            'url' => ['/contacts'],
        ],


    ],
]);
NavBar::end();
?>