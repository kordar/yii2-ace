<?php
namespace kordar\ace\web\assets\plugins\tools;

use kordar\ace\web\assets\AceBundleAsset;

class AdditionalMethodsAsset extends AceBundleAsset
{
    public $js = [
        'jquery-additional-methods.min.js'
    ];

    public $depends = [
        'yii\bootstrap\BootstrapPluginAsset',
    ];
}