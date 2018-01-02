<?php
namespace kordar\ace\web\assets;

use yii\web\AssetBundle;

/**
 * Configuration for Ace Admin client script files
 */
class DefaultAsset extends AssetBundle
{
    public $depends = [
        'kordar\ace\web\assets\AceAsset',
    ];
}
