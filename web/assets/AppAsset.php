<?php

namespace kordar\ace\web\assets;

use yii\web\AssetBundle;
use yii\web\View;

/**
 * Configuration for Ace Admin client script files
 */
class AppAsset extends AssetBundle
{
    public $sourcePath = '@kordar/ace/assets/web';

    public $css = [
        'css/style.css'
    ];

    public $js = [
        'js/tools.js',
    ];

    public $depends = [
        'kordar\ace\web\assets\AceAsset',
        //'kordar\ace\web\assets\plugins\JqueryUIAsset',
        'kordar\ace\web\assets\AceScriptAsset'
    ];
}
