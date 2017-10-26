<?php
namespace kordar\ace;

use yii\web\AssetBundle;

/**
 * Configuration for Ace Admin client script files
 */
class AttestAsset extends AssetBundle
{
    public $depends = [
        'kordar\ace\AceAsset',
    ];
}
