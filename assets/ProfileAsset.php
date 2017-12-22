<?php
namespace kordar\ace\assets;

use yii\web\AssetBundle;

/**
 * Configuration for Ace Admin client script files
 */
class ProfileAsset extends AssetBundle
{
    public $sourcePath = '@kordar/ace/assets/ace/assets';

    public $css = [
        'css/jquery.gritter.min.css',
        'css/bootstrap-editable.min.css',
        ['css/ace.min.css', 'class'=>'ace-main-stylesheet', 'id'=>'main-ace-style'],
    ];

    public $js = [
        'js/jquery.gritter.min.js',
        'js/bootstrap-editable.min.js',
        'js/ace-editable.min.js',
    ];

    public $depends = [
        'kordar\ace\assets\AceAsset',
    ];

}
