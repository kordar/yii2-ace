<?php
namespace kordar\ace\web\assets\plugins\tools;

use kordar\ace\web\assets\AceBundleAsset;

/**
 * Class SpinAsset
 * @package kordar\ace\web\assets\plugins\tools
 */
class SpinAsset extends AceBundleAsset
{
    public $js = [
        'js/spin.js'
    ];

    public $depends = [
        'kordar\ace\web\assets\plugins\JqueryUIAsset'
    ];
}