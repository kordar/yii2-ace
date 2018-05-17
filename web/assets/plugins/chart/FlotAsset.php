<?php
namespace kordar\ace\web\assets\plugins\chart;

use kordar\ace\web\assets\AceBundleAsset;

class FlotAsset extends AceBundleAsset
{
    public $js = [
        'js/jquery.flot.min.js',
        'js/jquery.flot.pie.min.js',
        'js/jquery.flot.resize.min.js'
    ];

    public $depends = [
        'kordar\ace\web\assets\plugins\JqueryUIAsset'
    ];
}