<?php
namespace kordar\ace\web\assets\plugins\view;

use kordar\ace\web\assets\AceBundleAsset;

class TreeViewAsset extends AceBundleAsset
{
    public $js = [
        'js/tree.min.js',
    ];

    public $depends = [
        'yii\bootstrap\BootstrapPluginAsset',
        'kordar\ace\web\assets\FontAwesomeAsset',
    ];
}