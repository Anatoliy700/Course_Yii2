<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log', 'eventHandlers', 'appLanguage'],
    'language' => 'ru-RU',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
        '@taskImageRoot' => '@app/web/img/task',
        '@taskImage' => '/img/task',
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'Q5Vvt-6obWg7CupIx5FpfPmCy117u2Il',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
            //'class' => 'yii\redis\Cache',
            /*'redis' => [
                'hostname' => 'localhost',
                'port' => 6379,
                'database' => 0,
            ]*/
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => \yii\log\FileTarget::class,
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,
        'eventHandlers' => [
            'class' => 'app\components\eventHandlers\RegisterEventHandlers'
        ],
        'i18n' => [
            'translations' => [
                'app*' => [
                    'class' => \yii\i18n\PhpMessageSource::class,
                    'basePath' => '@app/messages',
                    'sourceLanguage' => 'ru-RU',
                ]
            ]
        ],
        'appLanguage' => [
            'class' => \app\components\appLanguage\AppLanguage::class,
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                'tasks/<page:\d*>-<per-page:\d*>' => 'task/index',
                'tasks/<page:\d*>' => 'task/index',
                'tasks' => 'task/index',
                'task/<id:\d+>' => 'task/view',
                'task/<action:(update|delete)>/<id:\d+>' => 'task/<action>',
                '<module:(admin|lk)>/tasks/<page:\d*>-<per-page:\d*>' => '<module>/task/index',
                '<module:(admin|lk)>/tasks/<page:\d*>' => '<module>/task/index',
                '<module:(admin|lk)>/tasks' => '<module>/task/index',
                '<module:(admin|lk)>/task/<id:\d+>' => '<module>/task/view',
                '<module:(admin|lk)>/task/<action:(update|delete)>/<id:\d+>' => '<module>/task/<action>',
                '<module:(admin|lk)>/task/add-image/<id:\d+>' => '<module>/task/add-image',
            ],
        ],
        'authManager' => [
            'class' => \yii\rbac\DbManager::class,
        ],
    ],
    'modules' => [
        'lk' => [
            'class' => 'app\modules\lk\Lk',
        ],
        'admin' => [
            'class' => 'app\modules\admin\admin',
        ],
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
    
    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
