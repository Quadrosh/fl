<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace datender\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class ArticleAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'libs/slick/slick.css',
        'css/home.css',
        'css/style.css',
        'css/common/article.css',

    ];
    public $js = [
        'https://cdnjs.cloudflare.com/ajax/libs/gsap/2.0.2/TweenLite.min.js',
        'https://cdnjs.cloudflare.com/ajax/libs/gsap/2.0.2/utils/Draggable.min.js',
        'https://cdnjs.cloudflare.com/ajax/libs/gsap/2.0.2/plugins/CSSPlugin.min.js',
        'libs/slick/slick.min.js',
        'js/common/article.js',
        'js/targets_datender.js',

    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapPluginAsset',
    ];
}
