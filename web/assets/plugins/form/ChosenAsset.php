<?php
namespace kordar\ace\web\assets\plugins\form;

use kordar\ace\web\assets\AceBundleAsset;

class ChosenAsset extends AceBundleAsset
{
    public $css = [
        'css/chosen.min.css'
    ];

    public $js = [
        'js/chosen.jquery.min.js'
    ];

    public $depends = [
        'kordar\ace\web\assets\plugins\JqueryUIAsset'
    ];
}