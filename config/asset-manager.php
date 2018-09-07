<?php

return [
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
];