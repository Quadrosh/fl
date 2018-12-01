<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'libs/slick/slick.css',
        'css/site.css',
        'css/common/article.css',

    ];
    public $js = [

        'https://cdnjs.cloudflare.com/ajax/libs/gsap/2.0.2/TweenLite.min.js',
        'https://cdnjs.cloudflare.com/ajax/libs/gsap/2.0.2/utils/Draggable.min.js',
        'https://cdnjs.cloudflare.com/ajax/libs/gsap/2.0.2/plugins/CSSPlugin.min.js',
        'libs/slick/slick.min.js',
        'js/common/article.js',
        'js/backend.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
