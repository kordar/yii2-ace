<?php
namespace kordar\ace\web\assets\plugins\form;

use kordar\ace\web\assets\AceBundleAsset;

class DateRangePickerAsset extends AceBundleAsset
{
    public $css = [
        'css/daterangepicker.min.css'
    ];

    public $js = [
        'js/moment.min.js',
        'js/daterangepicker.min.js',
    ];

    public $depends = [
        'kordar\ace\web\assets\plugins\JqueryUIAsset'
    ];
}