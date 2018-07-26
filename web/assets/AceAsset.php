<?php
namespace kordar\ace\web\assets;

use kordar\ace\web\assets\AceBundleAsset;
use yii\web\View;

/**
 * Configuration for Ace Admin client script files
 */
class AceAsset extends AceBundleAsset
{
    public $css = [
        // text fonts
        'css/fonts.googleapis.com.css',

        // ace styles
        ['css/ace.min.css', 'class'=>'ace-main-stylesheet', 'id'=>'main-ace-style'],
        ['css/ace-part2.min.css', 'class'=>'ace-main-stylesheet', 'condition'=>'lte IE 9'],
        'css/ace-skins.min.css',
        'css/ace-rtl.min.css',
        ['css/ace-ie.min.css', 'condition'=>'lte IE 9'],

    ];

    public $js = [
        // javascript compatible script
        ['js/ace-extra.min.js', 'position'=>View::POS_HEAD],
        ['js/html5shiv.min.js', 'condition'=>'lte IE 8', 'position'=>View::POS_HEAD],
        ['js/respond.min.js', 'condition'=>'lte IE 8', 'position'=>View::POS_HEAD],
    ];

    public $depends = [
        'yii\bootstrap\BootstrapAsset',
        'kordar\ace\web\assets\FontAwesomeAsset',
    ];
}
