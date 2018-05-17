<?php
namespace kordar\ace\web\assets\plugins\form;

use kordar\ace\web\assets\AceBundleAsset;

class WysiwygAsset extends AceBundleAsset
{
    public $js = [
        'js/bootstrap-wysiwyg.min.js'
    ];

    public $depends = [
        'yii\bootstrap\BootstrapPluginAsset',
    ];
}