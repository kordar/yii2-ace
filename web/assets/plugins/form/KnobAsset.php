<?php
namespace kordar\ace\web\assets\plugins\form;

use kordar\ace\web\assets\AceBundleAsset;

class KnobAsset extends AceBundleAsset
{
    public $js = [
        'js/jquery.knob.min.js'
    ];

    public $depends = [
        'kordar\ace\web\assets\plugins\JqueryUIAsset'
    ];
}