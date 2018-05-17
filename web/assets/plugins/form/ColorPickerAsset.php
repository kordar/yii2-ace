<?php
namespace kordar\ace\web\assets\plugins\form;

use kordar\ace\web\assets\AceBundleAsset;

class ColorPickerAsset extends AceBundleAsset
{
    public $css = [
        'css/bootstrap-colorpicker.min.css'
    ];

    public $js = [
        'js/bootstrap-colorpicker.min.js',
    ];

    public $depends = [
        'kordar\ace\web\assets\plugins\JqueryUIAsset'
    ];
}