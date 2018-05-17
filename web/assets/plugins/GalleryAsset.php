<?php
namespace kordar\ace\web\assets\plugins;

use kordar\ace\web\assets\AceBundleAsset;

class GalleryAsset extends AceBundleAsset
{
    public $css = [
        'css/colorbox.min.css'
    ];

    public $js = [
        'js/jquery.colorbox.min.js',
    ];

    public $depends = [
        'yii\bootstrap\BootstrapPluginAsset',
        'kordar\ace\web\assets\FontAwesomeAsset',
    ];
}