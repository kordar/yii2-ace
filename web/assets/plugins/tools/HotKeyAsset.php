<?php
namespace kordar\ace\web\assets\plugins\tools;

use kordar\ace\web\assets\AceBundleAsset;

class HotKeyAsset extends AceBundleAsset
{
    public $js = [
        'js/jquery.hotkeys.index.min.js'
    ];

    public $depends = [
        'yii\bootstrap\BootstrapPluginAsset',
    ];
}