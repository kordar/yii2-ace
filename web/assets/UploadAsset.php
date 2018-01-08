<?php
/**
 * Created by perpel.
 * Created on 2018/1/2 0002 16:00
 */

namespace kordar\ace\web\assets;

class UploadAsset extends \yii\web\AssetBundle
{
    public $depends = [
        'yii\web\JqueryAsset',
        'kordar\ace\web\assets\BootboxAsset'
    ];
}