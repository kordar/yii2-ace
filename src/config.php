<?php

return [
    'assetManager' => [
        'appendTimestamp' => true,
        'bundles' => [
            'yii\web\JqueryAsset' => [
                'sourcePath' => '@vendor/kordar/yii2-ace/src/assets/ace/assets',
                'js' => [
                    ['js/jquery-2.1.4.min.js', 'condition'=>'!ie'],
                    ['js/jquery-1.11.3.min.js', 'condition'=>'ie'],
                ]
            ],
            'yii\bootstrap\BootstrapAsset' => [
                'sourcePath' => '@vendor/kordar/yii2-ace/src/assets/ace/assets',
                'css' => [
                    'css/bootstrap.min.css'
                ]
            ],
            'yii\bootstrap\BootstrapPluginAsset' => [
                'sourcePath' => '@vendor/kordar/yii2-ace/src/assets/ace/assets',
                'js' => [
                    'js/bootstrap.min.js'
                ]
            ],
        ],
    ],
];