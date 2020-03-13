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
            class="cpLogo"
            aria-labelledby="svg_logo_title"
            xmlns="http://www.w3.org/2000/svg"
            xmlns:xlink="http://www.w3.org/1999/xlink"
            x="0px" y="0px"
	        viewBox="0 0 1800 400"
	        style="enable-background:new 0 0 1800 400;"
	        xml:space="preserve">
<style type="text/css">
	.cpLogo_st0{fill:'.$fill.';}
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
</svg><span class="navbar_motto '.$mottoClass.'">Тендерное кредитование</span>',
    'brandUrl' => Yii::$app->homeUrl,
    'options' => [
        'class' => $nabarClass.' navbar-fixed-top ',
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
            'items' => [
                [
                    'label' => 'Банковская гарантия',
                    'url' => Yii::$app->request->url == '/bank_garant'?false:['/bank_garant'],
                    'active' => Yii::$app->request->url == '/bank_garant'?true:false,
                ],
                [
                    'label' => 'Банковская гарантия срочно',
                    'url' => Yii::$app->request->url == '/bank_garant/srochnoe-poluchenie-bankovskoi-garantii'?false:['/bank_garant/srochnoe-poluchenie-bankovskoi-garantii'],
                    'active' => Yii::$app->request->url == '/bank_garant/srochnoe-poluchenie-bankovskoi-garantii'?true:false,

                ],
                [
                    'label' => 'Банковская гарантия 44-ФЗ',
                    'url' => Yii::$app->request->url == '/bank_garant/kak-oformit-bankovskuyu-garantiyu-po-44-fz'?false:['/bank_garant/kak-oformit-bankovskuyu-garantiyu-po-44-fz'],
                    'active' => Yii::$app->request->url == '/bank_garant/kak-oformit-bankovskuyu-garantiyu-po-44-fz'?true:false,

                ],
                [
                    'label' => 'Банковская гарантия 223-ФЗ',
                    'url' => Yii::$app->request->url == '/bank_garant/bankovskaya-garantiya-223-fz'?false:['/bank_garant/bankovskaya-garantiya-223-fz'],
                    'active' => Yii::$app->request->url == '/bank_garant/bankovskaya-garantiya-223-fz'?true:false,

                ],

                [
                    'label' => 'Банковская гарантия в банке Восточный',
                    'url' => Yii::$app->request->url == '/bank_garant/bankovskaya-garantiya-v-banke-vostochnyi'?false:['/bank_garant/bankovskaya-garantiya-v-banke-vostochnyi'],
                    'active' => Yii::$app->request->url == '/bank_garant/bankovskaya-garantiya-v-banke-vostochnyi'?true:false,

                ],

            ],
        ],
        [
            'label' => 'Контакты',
            'url' => Yii::$app->request->url == '/contacts'?false:['/contacts'],
            'active' => Yii::$app->request->url == '/contacts'?true:false,
        ],
        [
            'url' => false,
            'format'=>'raw',
            'options'=>['class'=>'mainTopPhoneBox'],
            'label' => '<span class="phone_num">'.Yii::$app->params['mainPhone'].'</span><div class="svgIcons">
                            
                            <a href="https://wa.me/79775933863" title="WhatsApp" rel="nofollow" target="_blank">
<svg xmlns="http://www.w3.org/2000/svg"
     width="19" height="19"
     style="position:relative;top:-1px;"
     viewBox="0 0 737.509 740.824">
<style type="text/css">
	.icoWatsupp_st0{fill:'.$phoneFill.';}
</style>
	<path class="icoWatsupp_st0"  d="M630.056 107.658C560.727 38.271 468.525.039 370.294 0 167.891 0 3.16 164.668 3.079 367.072c-.027 64.699 16.883 127.855 49.016 183.523L0 740.824l194.666-51.047c53.634 29.244 114.022 44.656 175.481 44.682h.151c202.382 0 367.128-164.689 367.21-367.094.039-98.088-38.121-190.32-107.452-259.707m-259.758 564.8h-.125c-54.766-.021-108.483-14.729-155.343-42.529l-11.146-6.613-115.516 30.293 30.834-112.592-7.258-11.543c-30.552-48.58-46.689-104.729-46.665-162.379C65.146 198.865 202.065 62 370.419 62c81.521.031 158.154 31.81 215.779 89.482s89.342 134.332 89.311 215.859c-.07 168.242-136.987 305.117-305.211 305.117m167.415-228.514c-9.176-4.591-54.286-26.782-62.697-29.843-8.41-3.061-14.526-4.591-20.644 4.592-6.116 9.182-23.7 29.843-29.054 35.964-5.351 6.122-10.703 6.888-19.879 2.296-9.175-4.591-38.739-14.276-73.786-45.526-27.275-24.32-45.691-54.36-51.043-63.542-5.352-9.183-.569-14.148 4.024-18.72 4.127-4.11 9.175-10.713 13.763-16.07 4.587-5.356 6.116-9.182 9.174-15.303 3.059-6.122 1.53-11.479-.764-16.07-2.294-4.591-20.643-49.739-28.29-68.104-7.447-17.886-15.012-15.466-20.644-15.746-5.346-.266-11.469-.323-17.585-.323-6.117 0-16.057 2.296-24.468 11.478-8.41 9.183-32.112 31.374-32.112 76.521s32.877 88.763 37.465 94.885c4.587 6.122 64.699 98.771 156.741 138.502 21.891 9.45 38.982 15.093 52.307 19.323 21.981 6.979 41.983 5.994 57.793 3.633 17.628-2.633 54.285-22.19 61.932-43.616 7.646-21.426 7.646-39.791 5.352-43.617-2.293-3.826-8.41-6.122-17.585-10.714"/></svg>
                            </a>

                             <a href="https://telegram.im/@finlider"
                                title="Telegram"
                                rel="nofollow"
                                target="_blank">
                                 <svg version="1.1"
                                      xmlns="http://www.w3.org/2000/svg"
                                      width="20" height="20"
                                      xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                      viewBox="0 0 54 54"
                                      style="enable-background:new 0 0 54 54;"
                                      xml:space="preserve">
<style type="text/css">
	.icoTel_st0{fill:'.$phoneFill.';}
</style>
<g>

	<path class="icoTel_st0" d="M49.7,16.5c1.3,3.1,2,6.3,2,9.7s-0.7,6.6-2,9.7c-1.3,3.1-3.1,5.7-5.3,8c-2.2,2.2-4.9,4-8,5.3c-3.1,1.3-6.3,2-9.7,2
		c-3.4,0-6.6-0.7-9.7-2s-5.7-3.1-8-5.3c-2.2-2.2-4-4.9-5.3-8c-1.3-3.1-2-6.3-2-9.7s0.7-6.6,2-9.7c1.3-3.1,3.1-5.7,5.3-8
		c2.2-2.2,4.9-4,8-5.3s6.3-2,9.7-2c3.4,0,6.6,0.7,9.7,2c3.1,1.3,5.7,3.1,8,5.3C46.6,10.8,48.3,13.5,49.7,16.5z M34.8,37.7l4.1-19.3
		c0.2-0.8,0.1-1.4-0.3-1.8c-0.4-0.4-0.8-0.4-1.4-0.2l-24.1,9.3c-0.5,0.2-0.9,0.4-1.1,0.7c-0.2,0.3-0.2,0.5-0.1,0.7
		c0.1,0.2,0.4,0.4,0.9,0.5l6.2,1.9l14.3-9c0.4-0.3,0.7-0.3,0.9-0.2c0.1,0.1,0.1,0.2-0.1,0.4L22.5,31.3L22,37.7
		c0.4,0,0.8-0.2,1.3-0.6l3-2.9l6.2,4.6C33.8,39.5,34.5,39.1,34.8,37.7z"/>
</g>
</svg>
                             </a>

                    </div>',

        ],


    ],
]);
NavBar::end();
?>