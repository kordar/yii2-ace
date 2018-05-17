<?php
namespace kordar\ace\web\assets\plugins;

use kordar\ace\web\assets\AceBundleAsset;

class JqueryUIAsset extends AceBundleAsset
{
    public $css = [
        'css/jquery-ui.custom.min.css',
    ];

    public $js = [
        ['js/excanvas.min.js', 'condition'=>'lte IE 8'],
        'js/jquery-ui.custom.min.js',
        'js/jquery.ui.touch-punch.min.js',
    ];

    public $depends = [
        'yii\bootstrap\BootstrapPluginAsset',
        'kordar\ace\web\assets\FontAwesomeAsset',
    ];
}