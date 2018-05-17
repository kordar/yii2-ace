<?php
namespace kordar\ace\web\assets;

class FontAwesomeAsset extends AceBundleAsset
{
    public $css = [
        // 4.7.0版本Font Awesome 参考地址：http://www.fontawesome.com.cn/
        'font-awesome/4.5.0/css/font-awesome.min.css',
    ];

    public $depends = [
        'yii\bootstrap\BootstrapAsset',
    ];
}