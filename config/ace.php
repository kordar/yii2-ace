<?php

return [

    'modules' => [
        'ace' => [
            'class' => 'kordar\ace\Module',
        ],
        'rbac' => [
            'class' => 'kordar\ace\modules\rbac\Module',
        ],
    ],


    'components' => [

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
            'name' => 'ace-admin',
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

    ]

];