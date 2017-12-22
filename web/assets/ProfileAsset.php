<?php
namespace kordar\ace\web\assets;

use yii\web\AssetBundle;

class ProfileAsset extends AssetBundle
{
    public $sourcePath = '@kordar/ace/assets/sys';

    public $depends = [
        'kordar\ace\web\assets\JqueryGritterAsset',
        'kordar\ace\web\assets\BootstrapEditableAsset',
        'kordar\ace\web\assets\AceAsset',
    ];
}
