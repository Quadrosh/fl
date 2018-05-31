<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
//        'libs/slick/slick.min.css',
//        'libs/magnific/magnificpopup.min.css',
        'libs/font-awesome/css/font-awesome.min.css',
        'https://fonts.googleapis.com/css?family=Montserrat:200,300,500,600,700|Roboto:300,400&amp;subset=cyrillic',
        'css/home.css',
    ];
    public $js = [
        'libs/gsap/TimelineMax.min.js',
        'libs/gsap/TweenMax.min.js',
        'libs/slick/slick.min.js',
        'libs/magnific/magnificpopup.min.js',
        'js/home.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
