<?php
namespace kordar\ace\web\assets\plugins\form;

use kordar\ace\web\assets\AceBundleAsset;

class TagAsset extends AceBundleAsset
{
    public $js = [
        'js/bootstrap-tag.min.js'
    ];

    public $depends = [
        'kordar\ace\web\assets\plugins\JqueryUIAsset'
    ];
}