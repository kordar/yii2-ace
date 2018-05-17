<?php
namespace kordar\ace\web\assets\plugins\form;

use kordar\ace\web\assets\AceBundleAsset;

class WizardAsset extends AceBundleAsset
{
    public $css = [
        'css/select2.min.css'
    ];

    public $js = [
        'js/wizard.min.js',
        'js/select2.min.js'
    ];

    public $depends = [
        'kordar\ace\web\assets\plugins\JqueryUIAsset',
        'kordar\ace\web\assets\plugins\tools\ValidateAsset',
        'kordar\ace\web\assets\plugins\tools\AdditionalMethodsAsset',
        'kordar\ace\web\assets\plugins\tools\BootboxAsset',
        'kordar\ace\web\assets\plugins\form\MaskedInputAsset',
    ];
}