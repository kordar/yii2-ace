<?php
namespace kordar\ace\web\assets\plugins\form;

use kordar\ace\web\assets\AceBundleAsset;

class DropZoneAsset extends AceBundleAsset
{
    public $css = [
        'css/dropzone.min.css'
    ];

    public $js = [
        'js/dropzone.min.js'
    ];

    public $depends = [
        'yii\bootstrap\BootstrapPluginAsset',
        'kordar\ace\web\assets\FontAwesomeAsset',
    ];
}