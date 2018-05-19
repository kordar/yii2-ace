<?php
/**
 * Created by perpel.
 * Created on 2018/1/2 0002 16:00
 */

namespace kordar\ace\web\assets;

class EditorMdAsset extends \kordar\editormd\EditorMdAsset
{
    public $depends = [
        'kordar\ace\web\assets\AceAsset',
    ];
}