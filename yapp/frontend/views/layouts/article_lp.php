<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use yii\bootstrap\ActiveForm;

frontend\assets\ArticleAsset::register($this);


?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title> <?= Yii::$app->view->params['meta']['title'] ?> </title>
    <meta name="description" content="<?= Yii::$app->view->params['meta']['description'] ?>">
    <meta name="keywords" content="<?= Yii::$app->view->params['meta']['keywords'] ?>">

    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">

    <meta property="og:locale" content="ru_RU" />
    <meta property="og:type" content="website" />
    <meta property="og:site_name" content="ФинЛидер" />
    <meta property="og:title" content="<?= Yii::$app->view->params['meta']['title'] ?>" />
    <meta property="og:description" content="<?= Yii::$app->view->params['meta']['description'] ?>" />
    <meta property="og:url" content="<?= \yii\helpers\Url::current(['lg'=>null], true) ?>" />
    <meta property="og:image" content="<?= \yii\helpers\Url::base(true) ?>/img/logo_finlider_square.png" />

    <?php $this->head() ?>
    <?php include_once("stat_google.php") ?>
</head>
<body >
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
//    NavBar::begin([
//        'brandLabel' => '<svg version="1.1"
//            class="cpLogo"
//            aria-labelledby="svg_logo_title"
//            xmlns="http://www.w3.org/2000/svg"
//            xmlns:xlink="http://www.w3.org/1999/xlink"
//            x="0px" y="0px"
//	        viewBox="0 0 1800 400"
//	        style="enable-background:new 0 0 1800 400;"
//	        xml:space="preserve">
//<title id="svg_logo_title"> ФинЛидер -'.Yii::$app->view->params['meta']['h1'].'</title>
//<style type="text/css">
//	.cpLogo_st0{fill:#58595B;}
//</style>
//<g >
//	<rect  x="160.3" y="121.3" class="cpLogo_st0" width="58.5" height="175.5"/>
//	<circle  class="cpLogo_st0" cx="188.3" cy="73.4" r="29.2"/>
//	<rect  x="248" y="209.1" class="cpLogo_st0" width="58.5" height="87.7"/>
//	<circle  class="cpLogo_st0" cx="277.9" cy="161" r="29.2"/>
//	<rect  x="71.9" y="209.1" class="cpLogo_st0" width="58.5" height="87.7"/>
//	<circle  class="cpLogo_st0" cx="101.8" cy="161" r="29.2"/>
//</g>
//<path  class="cpLogo_st0" d="M499.1,120.7h4.2c14.8,0.1,28.2,3.5,40.4,10.3c12.2,6.8,21.6,16.2,28.4,28.1
//	c6.8,12,10.1,25.3,10.1,40.1c0,14.9-3.4,28.3-10.2,40.4c-6.8,12.1-16.2,21.5-28.2,28.3c-12,6.8-25.3,10.2-40,10.4h-4.7v26.3h-25
//	v-26.3h-3.8c-15,0-28.5-3.4-40.8-10.2c-12.2-6.8-21.7-16.2-28.5-28.2c-6.8-12-10.1-25.5-10.1-40.4c0-14.9,3.4-28.4,10.1-40.4
//	c6.8-12,16.2-21.4,28.5-28.2c12.2-6.8,25.8-10.2,40.8-10.2h3.8V93h25V120.7z M470.4,141c-16.8,0-30.1,5.2-39.9,15.5
//	c-9.8,10.3-14.7,24.7-14.7,43c0,18.4,4.9,32.8,14.6,43c9.8,10.3,23.2,15.4,40.3,15.4h3.5V141H470.4z M499.1,141v117h3.8
//	c17.1,0,30.5-5.3,40.1-15.8c9.6-10.5,14.4-24.8,14.4-42.9c0-17.9-4.8-32.1-14.4-42.6c-9.6-10.5-23.2-15.7-40.6-15.7H499.1z"/>
//<path  class="cpLogo_st0" d="M704.8,151.3h24.8v145.3h-24.8V190.7l-67,105.9H613V151.3h24.8v106.1L704.8,151.3z"/>
//<path  class="cpLogo_st0" d="M888.2,296.6h-24.8v-62h-66.7v62h-25V151.3h25v63h66.7v-63h24.8V296.6z"/>
//<path  class="cpLogo_st0" d="M1201.5,151.3h24.8v145.3h-24.8V190.7l-67,105.9h-24.8V151.3h24.8v106.1L1201.5,151.3z"/>
//<path  class="cpLogo_st0" d="M1265,276.3l8.6-10.6c9.7-12.5,15.2-31.3,16.5-56.4l2.3-58h93.6v125h18.7v63h-24.8v-42.7
//	h-101.4v42.7h-24.8l0.1-63H1265z M1294.4,276.3h66.7V174.3h-44.7l-1.5,34.6C1313.5,237.8,1306.6,260.3,1294.4,276.3z"/>
//<path  class="cpLogo_st0" d="M1492.5,299.3c-19.7,0-35.7-6.5-48.1-19.4c-12.4-12.9-18.5-30.2-18.5-51.9v-4.6
//	c0-14.4,2.8-27.3,8.3-38.6c5.5-11.3,13.2-20.2,23.1-26.6c9.9-6.4,20.6-9.6,32.2-9.6c18.9,0,33.6,6.2,44,18.7
//	c10.5,12.4,15.7,30.3,15.7,53.4v10.3h-98.4c0.4,14.3,4.5,25.9,12.6,34.7c8,8.8,18.2,13.2,30.5,13.2c8.8,0,16.2-1.8,22.3-5.4
//	c6.1-3.6,11.4-8.3,16-14.2l15.2,11.8C1535.1,289.9,1516.8,299.3,1492.5,299.3z M1489.4,169c-10,0-18.4,3.6-25.2,10.9
//	c-6.8,7.3-11,17.5-12.6,30.7h72.8v-1.9c-0.7-12.6-4.1-22.4-10.2-29.3C1508,172.5,1499.8,169,1489.4,169z"/>
//<path  class="cpLogo_st0" d="M1700.6,225.6c0,22.1-5.1,39.9-15.2,53.4c-10.1,13.5-23.8,20.3-41.1,20.3
//	c-17.6,0-31.5-5.6-41.6-16.8v70h-24.8V151.3h22.7l1.2,16.1c10.1-12.5,24.2-18.8,42.2-18.8c17.5,0,31.3,6.6,41.4,19.7
//	c10.2,13.2,15.2,31.5,15.2,54.9V225.6z M1675.8,222.8c0-16.4-3.5-29.3-10.5-38.8c-7-9.5-16.6-14.2-28.7-14.2c-15,0-26.3,6.7-33.8,20
//	v69.4c7.4,13.2,18.8,19.9,34.1,19.9c11.9,0,21.4-4.7,28.4-14.2C1672.3,255.4,1675.8,241.4,1675.8,222.8z"/>
//<path  class="cpLogo_st0" d="M999,132.9c19.9,54.6,39.7,109.1,59.6,163.7h26.5l-74.8-195.5h-22.6l-74.7,195.5h26.6
//	C959.5,242,979.2,187.5,999,132.9z"/>
//</svg><span class="navbar_motto onBright">Тендерное финансирование</span>',
//        'brandUrl' => Yii::$app->homeUrl,
//        'options' => [
//            'class' => 'navbar navbar-fixed-top relative',
//        ],
//    ]);
//    echo Nav::widget([
//        'options' => ['class' => 'navbar-nav navbar-right'],
//        'encodeLabels' => false,
//        'items' => [
//            [
//                'label' => 'Главная',
//                'url' => ['/'],
//            ],
//            [
//                'label' => 'Тендерный займ',
//                'url' => Yii::$app->request->url == '/tender_zaim'?false:['/tender_zaim'],
//                'active' => Yii::$app->request->url == '/tender_zaim'?true:false,
//            ],
//            [
//                'label' => 'Банковская гарантия',
//                'items' => [
//                    [
//                        'label' => 'Банковская гарантия',
//                        'url' => Yii::$app->request->url == '/bank_garant'?false:['/bank_garant'],
//                        'active' => Yii::$app->request->url == '/bank_garant'?true:false,
//                    ],
//                    [
//                        'label' => 'Банковская гарантия срочно',
//                        'url' => Yii::$app->request->url == '/bank_garant/srochnoe-poluchenie-bankovskoi-garantii'?false:['/bank_garant/srochnoe-poluchenie-bankovskoi-garantii']],
//
//                ],
//            ],
//            [
//                'label' => 'Контакты',
//                'url' => Yii::$app->request->url == '/contacts'?false:['/contacts'],
//                'active' => Yii::$app->request->url == '/contacts'?true:false,
//            ],
//            [
//                'label' => '<svg version="1.1"
//                                 class="phone_icon"
//                                 xmlns="http://www.w3.org/2000/svg"
//                                 xmlns:xlink="http://www.w3.org/1999/xlink"
//                                 x="0px" y="0px"
//                                 viewBox="0 0 16.2 14.6"
//                                 style="enable-background:new 0 0 16.2 14.6;"
//                                 xml:space="preserve">
//                        <style type="text/css">
//                            .phone_icon_st0{fill:#414042;}
//                        </style>
//                                <g >
//                                    <path  class="phone_icon_st0" d="M13.7,12.5c0,0-0.9,0.9-2.2,1.1c0,0-2.7-1.6-3.4-2c-0.7-0.4-2.9-2.4-4.2-4.3S1.9,4,1.9,4
//		S1.8,2.7,2.9,1.7l2.4,3.5c0,0-0.4,0.7,0,1.2c0.4,0.5,3.9,3.9,3.9,3.9s0.5,0.2,1-0.1L13.7,12.5z"/>
//                                    <path  class="phone_icon_st0" d="M6,4.6L5.6,4.9L3.2,1.5l0.5-0.3C3.8,1,4,1.1,4.1,1.2l2,2.9C6.2,4.3,6.2,4.5,6,4.6z"/>
//                                    <path  class="phone_icon_st0" d="M14.2,11.7l-0.3,0.5l-3.6-2.3l0.3-0.5c0.1-0.2,0.3-0.2,0.5-0.1l3,1.9
//		C14.2,11.3,14.3,11.5,14.2,11.7z"/>
//                                </g>
//                        </svg><span class="phone_num">'.Yii::$app->params['mainPhone'].'</span>',
//                'url' => ['/contacts'],
//            ],
//
//
//        ],
//    ]);
//    NavBar::end();
    ?>
    <?= $this->render('/layouts/navbar_lp', []) ?>

    <div class="container">

        <div class="row  text-center">

            <?= \common\widgets\Alert::widget() ?>
        </div>


        <?= $content ?>

    </div>

</div>

<?php $this->endBody() ?>
<?php include_once("stat_yandex.php") ?>
</body>
</html>
<?php $this->endPage() ?>
