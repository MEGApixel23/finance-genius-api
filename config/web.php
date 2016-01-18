<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'api-fg',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],

    'modules' => [
        'v1' => [
            'class' => 'api\v1\Module',
        ],
    ],

    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
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
                '/auth' => 'v1/user/auth',
                '/sign-up' => 'v1/user/sign-up'
            ],
        ],

        'db' => require(__DIR__ . '/db.php'),
    ],
    'params' => $params,
];

return $config;
