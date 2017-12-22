<?php

namespace kordar\ace\web\assets;

use yii\web\AssetBundle;
use yii\web\View;

/**
 * Configuration for Ace Admin client script files
 */
class AceAsset extends AceBundle
{
    public $css = [
        ['css/ace.min.css', 'class'=>'ace-main-stylesheet', 'id'=>'main-ace-style'],
        ['css/ace-part2.min.css', 'class'=>'ace-main-stylesheet', 'condition'=>'lte IE 9'],
        'css/ace-skins.min.css',
        'css/ace-rtl.min.css',
        ['css/ace-ie.min.css', 'condition'=>'lte IE 9'],
    ];

    public $js = [
        ['js/ace-extra.min.js', 'position'=>View::POS_HEAD],
        ['js/html5shiv.min.js', 'condition'=>'lte IE 8', 'position'=>View::POS_HEAD],
        ['js/respond.min.js', 'condition'=>'lte IE 8', 'position'=>View::POS_HEAD],
        'js/ace-elements.min.js',
        'js/ace.min.js',
    ];

    public $depends = [
        'kordar\ace\web\assets\FontAwesomeAsset',
        'kordar\ace\web\assets\JqueryUIAsset',
        'kordar\ace\web\assets\FontsGoogleApiAsset',
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\bootstrap\BootstrapPluginAsset',
    ];

}
