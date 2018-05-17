<?php
namespace kordar\ace\web\assets\plugins\tools;

use kordar\ace\web\assets\AceBundleAsset;

class BootboxAsset extends AceBundleAsset
{
    public $js = [
        'js/bootbox.js'
    ];

    public $depends = [
        'yii\bootstrap\BootstrapPluginAsset',
    ];
}