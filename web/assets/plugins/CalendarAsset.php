<?php
namespace kordar\ace\web\assets\plugins;

use kordar\ace\web\assets\AceBundleAsset;

class CalendarAsset extends AceBundleAsset
{
    public $css = [
        'css/fullcalendar.min.css'
    ];

    public $js = [
        'js/moment.min.js',
        'js/fullcalendar.min.js',
    ];

    public $depends = [
        'kordar\ace\web\assets\plugins\JqueryUIAsset',
        'kordar\ace\web\assets\plugins\tools\BootboxAsset',
    ];
}