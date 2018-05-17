<?php
namespace kordar\ace\web\assets\plugins\view;

use kordar\ace\web\assets\AceBundleAsset;

class PrettifyAsset extends AceBundleAsset
{
    public $css = [
        'css/prettify.min.css'
    ];

    public $js = [
        'js/prettify.min.js',
    ];

    public $depends = [
        'yii\bootstrap\BootstrapPluginAsset',
        'kordar\ace\web\assets\FontAwesomeAsset',
    ];
}