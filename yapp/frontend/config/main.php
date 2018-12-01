<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'language' => 'ru-RU',
//    'defaultRoute' => 'site/index',
    'timeZone' => 'Europe/Moscow',
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-frontend',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
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
                '' => 'landing/page',
//                'tender_zaim' => 'landing/page',
//                'bank_garant' => 'landing/page',
//                'contacts' => 'site/contacts',
                'lp/<landingpage:[0-9a-z\-\_]+>' => 'landing/page',
                'article/calculator' => 'article/calculator',
                'article/calc' => 'article/calc',
                'article' => 'article/index',
                'article/<hrurl:[0-9a-z\-\_]+>' => 'article/article',
                '<pagename:[0-9a-z\-\_]+>' => 'site/page',
                'site/order' => 'site/order',
                '<pagename:[0-9a-z\-\_]+/[0-9a-z\-\_]+>' => 'site/page',

            ],
        ],

    ],
    'params' => $params,
];
