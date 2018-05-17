<?php
namespace kordar\ace\web\assets\plugins\form;

use kordar\ace\web\assets\AceBundleAsset;

class TimePickerAsset extends AceBundleAsset
{
    public $css = [
        'css/bootstrap-timepicker.min.css'
    ];

    public $js = [
        'js/bootstrap-timepicker.min.js'
    ];

    public $depends = [
        'kordar\ace\web\assets\plugins\JqueryUIAsset'
    ];
}