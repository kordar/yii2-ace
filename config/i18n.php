<?php

return [
    'translations' => [
        'ace*' => [
            'class' => 'yii\i18n\PhpMessageSource',
            'basePath' => '@kordar/ace/web/messages',
            // 'sourceLanguage' => 'en-US',
            'fileMap' => [
                'ace' => 'ace.php',
                'ace.sidebar' => 'ace.sidebar.php',
                'app/error' => 'error.php',
            ],
        ],
        // 上传组件语言包
        'upload' => [
            'class' => 'yii\i18n\PhpMessageSource',
            'basePath' => '@kordar/upload/messages',
        ],
    ],
];