<?php
namespace kordar\ace\web\assets\plugins\tools;

use kordar\ace\web\assets\AceBundleAsset;

class ValidateAsset extends AceBundleAsset
{
    public $js = [
        'js/jquery.validate.min.js'
    ];

    public $depends = [
        'yii\bootstrap\BootstrapPluginAsset',
    ];
}