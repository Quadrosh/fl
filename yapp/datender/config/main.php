<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-datender',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'language' => 'ru-RU',
//    'defaultRoute' => 'site/index',
    'timeZone' => 'Europe/Moscow',
    'controllerNamespace' => 'datender\controllers',
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-datender',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-datender',
            'cookieParams' => ['httponly' => true, 'lifetime' => 3600 * 12],
            'timeout' => 3600*12, //session expire
            'useCookies' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],

        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '' => 'article/home',
                'bank_garant' => 'article/bg',
                'tender_zaim' => 'article/tz',
//                '' => 'article/index',
                'contacts' => 'site/contacts',
                'sitemap.xml' => 'site/sitemap',


            ],
        ],

    ],
    'params' => $params,
];
