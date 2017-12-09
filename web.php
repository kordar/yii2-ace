<?php

$params = require(__DIR__ . '/params.php');
$db = require(__DIR__ . '/db.php');

$config = [

    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],

    'language' => 'zh-CN',

    'aliases' => [
        '@kordar/ace' => dirname(__DIR__) . '/runtime/tmp-extensions/kordar-ace',
    ],

    'defaultRoute' => 'ace/default/index',

    'layoutPath' => '@kordar/ace/views/layouts',  # 布局文件
    'layout' => 'main',

    'modules' => [
        'ace' => [
            'class' => 'kordar\ace\Module',
        ],
        'rbac' => [
            'class' => 'kordar\ace\modules\rbac\Module',
        ],
    ],

    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'yrv7KJ0nXa9pSpEU-ak5F0o__bmWiHEf',
        ],

        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],


        # 用户登录认证管理
        'user' => [
            'identityClass' => 'kordar\ace\models\Admin',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '__ace_identity', 'httpOnly' => true],
            'idParam' => '__ace_admin',
            'loginUrl' => ['/ace/auth/login'],
        ],

        # session 基本配置
        'session' => [
            // this is the name of the session cookie used for login on the backend
            // 'name' => 'ace-admin',
            'class' => 'yii\redis\Session',
            'redis' => [
                'hostname' => '127.0.0.1',
                'port' => 6379,
                'database' => 1,
            ]
        ],

        'authManager' => [
            'class' => 'yii\rbac\DbManager',
            'itemTable' => '{{%auth_item}}',
            'itemChildTable' => '{{%auth_item_child}}',
            'assignmentTable' => '{{%auth_assignment}}',
            'ruleTable' => '{{%auth_rule}}',
            'defaultRoles' => ['guest'],
        ],

        'assetManager' => [

            'class' => 'yii\web\AssetManager',
            'appendTimestamp' => true,
            'forceCopy' => false,

            'bundles' => [
                'yii\web\JqueryAsset' => [
                    'sourcePath' => '@kordar/ace/assets/ace/assets',
                    'js' => [
                        ['js/jquery-2.1.4.min.js', 'condition'=>'!IE'],
                        ['js/jquery-1.11.3.min.js', 'condition'=>'IE'],
                    ]
                ],
                'yii\bootstrap\BootstrapAsset' => [
                    'sourcePath' => '@kordar/ace/assets/ace/assets',
                    'css' => [
                        'css/bootstrap.min.css'
                    ]
                ],
                'yii\bootstrap\BootstrapPluginAsset' => [
                    'sourcePath' => '@kordar/ace/assets/ace/assets',
                    'js' => [
                        'js/bootstrap.min.js'
                    ]
                ],
            ],
        ],

        'errorHandler' => [
            'errorAction' => 'ace/default/error',
        ],

        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@kordar/ams/mail',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => false,
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                //我用的是QQ 的代理，所以这里是 QQ 的配置信息
                'host' => 'smtp.qq.com',
                'port' => 587,
                'encryption' => 'tls',
                //这部分信息不应该公开，所以后期会由数据库中拿取
                'username' => '605205796',
                'password' => 'fjpouagngihgbbbe',
            ],

            //发送的邮件信息配置
            'messageConfig' => [

                'charset' => 'utf-8',

                'from' => ['605205796@qq.com' => '阿毛']
            ],
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
        'db' => $db,

        'redis' => [
            'class' => 'yii\redis\Connection',
            'hostname' => '127.0.0.1',
            'port' => 6379,
        ],

        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [],
        ],

        'i18n' => [
            'translations' => [
                'ace*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@kordar/ace/messages',
                    'fileMap' => [
                        'ace' => 'ace.php',
                        'sidebar' => 'sidebar.php',
                        'ace/error' => 'error.php',
                    ],
                ],
            ],
        ],

        'formatter' => [
            'dateFormat' => 'yyyy-MM-dd',
            'datetimeFormat' => 'yyyy-MM-dd HH:mm:ss',
            /*'decimalSeparator' => ',',
            'thousandSeparator' => ' ',
            'currencyCode' => 'CNY',*/
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
        'allowedIPs' => ['127.0.0.1', '::1', '*'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        'allowedIPs' => ['127.0.0.1', '::1', '*'],
    ];
}

return $config;
