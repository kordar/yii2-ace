<?php

namespace kordar\ace\assets;

use yii\web\AssetBundle;
use yii\web\View;

/**
 * Configuration for Ace Admin client script files
 */
class AceAsset extends AssetBundle
{

    public $sourcePath = '@kordar/ace/assets/ace/assets';

    public $css = [
        'font-awesome/4.7.0/css/font-awesome.min.css',
        'css/jquery-ui.custom.min.css',
        'css/chosen.min.css',
        'css/fonts.googleapis.com.css',

        ['css/ace-part2.min.css', 'class'=>'ace-main-stylesheet', 'condition'=>'lte IE 9'],
        'css/ace-skins.min.css',
        'css/ace-rtl.min.css',
        ['css/ace-ie.min.css', 'condition'=>'lte IE 9'],
    ];

    public $js = [
        ['js/ace-extra.min.js', 'position'=>View::POS_HEAD],
        ['js/html5shiv.min.js', 'condition'=>'lte IE 8', 'position'=>View::POS_HEAD],
        ['js/respond.min.js', 'condition'=>'lte IE 8', 'position'=>View::POS_HEAD],
        // ext
        ['js/excanvas.min.js', 'condition'=>'lte IE 8'],
        'js/jquery-ui.custom.min.js',
        'js/jquery.ui.touch-punch.min.js',
        'js/jquery.easypiechart.min.js',
        'js/jquery.sparkline.index.min.js',
        'js/jquery.flot.min.js',
        'js/jquery.flot.pie.min.js',
        'js/jquery.flot.resize.min.js',
        'js/bootbox.js',
        'js/ace-elements.min.js',
        'js/ace.min.js',
        'js/chosen.jquery.min.js',

    ];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\bootstrap\BootstrapPluginAsset',
    ];

}
