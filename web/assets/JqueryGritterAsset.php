<?php
namespace kordar\ace\web\assets;

class JqueryGritterAsset extends AceBundle
{
    public $css = [
        'css/jquery.gritter.min.css',
    ];

    public $js = [
        'js/jquery.gritter.min.js',
    ];

    public $depends = [
        'yii\web\YiiAsset',
    ];
}