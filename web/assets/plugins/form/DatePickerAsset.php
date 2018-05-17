<?php
namespace kordar\ace\web\assets\plugins\form;

use kordar\ace\web\assets\AceBundleAsset;

class DatePickerAsset extends AceBundleAsset
{
    public $css = [
        'css/bootstrap-datepicker3.min.css'
    ];

    public $js = [
        'js/bootstrap-datepicker.min.js'
    ];

    public $depends = [
        'kordar\ace\web\assets\plugins\JqueryUIAsset'
    ];
}