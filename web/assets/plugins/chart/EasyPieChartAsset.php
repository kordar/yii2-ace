<?php
namespace kordar\ace\web\assets\plugins\chart;

use kordar\ace\web\assets\AceBundleAsset;

class EasyPieChartAsset extends AceBundleAsset
{
    public $js = [
       'js/jquery.easypiechart.min.js'
    ];

    public $depends = [
        'kordar\ace\web\assets\plugins\JqueryUIAsset'
    ];
}