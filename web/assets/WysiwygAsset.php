<?php

namespace kordar\ace\web\assets;

use yii\web\AssetBundle;

/**
 * Configuration for Ace Admin client script files
 */
class WysiwygAsset extends AceBundle
{
    public $js = [
        'js/jquery.hotkeys.index.min.js',
        'js/bootstrap-wysiwyg.min.js'
    ];

    public $depends = [
        'kordar\ace\web\assets\AceAsset',
    ];

}
