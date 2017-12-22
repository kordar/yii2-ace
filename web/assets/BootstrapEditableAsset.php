<?php
namespace kordar\ace\web\assets;

class BootstrapEditableAsset extends AceBundle
{
    public $css = [
        'css/bootstrap-editable.min.css',
    ];

    public $js = [
        'js/bootstrap-editable.min.js',
        'js/ace-editable.min.js',
    ];

    public $depends = [
        'yii\bootstrap\BootstrapPluginAsset',
    ];
}