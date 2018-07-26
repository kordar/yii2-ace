<?php

return [

    'modules' => [
        'ace' => [
            'class' => 'kordar\ace\Module',
        ]
    ],


    'components' => [

        # 用户登录认证管理
        'user' => [
            'identityClass' => 'kordar\ace\models\admin\Admin',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '__ace_identity', 'httpOnly' => true],
            'idParam' => '__ace_admin',
            'loginUrl' => ['/ace/auth/login'],
        ],

        'redis' => [
            'class' => 'yii\redis\Connection',
            'hostname' => 'toomee-redis',
            'port' => 6379,
            'database' => 0,
        ],

        # session 基本配置
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'class'=>'yii\redis\Session',
            //'timeout'=>3600,
            /*'keyPrefix'=>'qian',
            'cookieParams' => [
                'path' => '/',
                'domain' => ".qian.com",
            ],*/
            'redis' => [
                'class' => 'yii\redis\Connection',
                'hostname' => 'toomee-redis',
                'port' => 6379,
                'database' => 1,
            ],
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
                    'sourcePath' => '@bower/aceadmin/assets',
                    'js' => [
                        ['js/jquery-2.1.4.min.js', 'condition'=>'!IE'],
                        ['js/jquery-1.11.3.min.js', 'condition'=>'IE'],
                    ]
                ],
                'yii\bootstrap\BootstrapAsset' => [
                    'sourcePath' => '@bower/aceadmin/assets',
                    'css' => [
                        'css/bootstrap.min.css'
                    ]
                ],
                'yii\bootstrap\BootstrapPluginAsset' => [
                    'sourcePath' => '@bower/aceadmin/assets',
                    'js' => [
                        'js/bootstrap.min.js'
                    ]
                ],
            ],
        ],

        'errorHandler' => [
            'errorAction' => 'ace/default/error',
        ],

    ],

    'params' => [
        'activeDownList' => ['否', '是'],
        'authKeys' => []
    ]

];