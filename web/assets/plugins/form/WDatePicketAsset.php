<?php
namespace kordar\ace\web\assets\plugins\form;

use yii\web\AssetBundle;

class WDatePicketAsset extends AssetBundle
{
    public $sourcePath = '@kordar/ace/assets/My97DatePicker';

    public $js = [
        'WdatePicker.js'
    ];

    public $depends = [];
}