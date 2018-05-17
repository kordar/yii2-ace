<?php
namespace kordar\ace\web\assets\plugins\tools;

use kordar\ace\web\assets\AceBundleAsset;

/**
 * Class GritterAsset
 * @package kordar\ace\web\assets\plugins\tools
 */
class GritterAsset extends AceBundleAsset
{
    public $js = [
        'js/jquery.gritter.min.js'
    ];

    public $depends = [
        'kordar\ace\web\assets\plugins\JqueryUIAsset'
    ];
}