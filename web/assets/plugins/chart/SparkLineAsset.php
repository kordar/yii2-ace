<?php
namespace kordar\ace\web\assets\plugins\chart;

use kordar\ace\web\assets\AceBundleAsset;

class SparkLineAsset extends AceBundleAsset
{
    public $js = [
       'js/jquery.sparkline.index.min.js'
    ];

    public $depends = [
        'kordar\ace\web\assets\plugins\JqueryUIAsset'
    ];
}