<?php
namespace kordar\ace\web\assets\plugins\tools;

use kordar\ace\web\assets\AceBundleAsset;

class NestableAsset extends AceBundleAsset
{
    public $js = [
        'js/jquery.nestable.min.js'
    ];

    public $depends = [
        'yii\bootstrap\BootstrapPluginAsset',
    ];
}