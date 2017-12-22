<?php
namespace kordar\ace\web\assets;

class JqueryUIAsset extends AceBundle
{
    public $css = [
        'css/jquery-ui.custom.min.css',
    ];

    public $js = [
        'js/jquery-ui.custom.min.js',
        'js/jquery.ui.touch-punch.min.js',
    ];

    public $depends = [
        'yii\web\YiiAsset',
    ];
}