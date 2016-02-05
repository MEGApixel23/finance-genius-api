<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'api-fg',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log', function () {
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Headers: token');
    }],

    'modules' => [
        'v1' => [
            'class' => 'api\v1\Module',
        ],
    ],

    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],

        'request' => [
            'enableCookieValidation' => false,
            'enableCsrfValidation' => false,
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

        'urlManager' => [
            'enablePrettyUrl' => true,
            'enableStrictParsing' => true,
            'showScriptName' => false,
            'rules' => [
                'OPTIONS <url:.*>' =>  'v1/echo',

                // Auth & SignUp
                'POST /sign-up' => 'v1/user/sign-up',
                'POST /auth' => 'v1/user/auth',

                // Wallets
                'GET /wallet' => 'v1/wallet/index',
                'POST /wallet' => 'v1/wallet/create',

                // Categories
                'GET /category' => 'v1/category/index',
                'POST /category' => 'v1/category/create',

                // Currency
                'GET /currency' => 'v1/currency/index',
                'POST /currency' => 'v1/currency/create',
            ],
        ],

        'db' => require(__DIR__ . '/db.php'),
    ],
    'params' => $params,
];

return $config;
