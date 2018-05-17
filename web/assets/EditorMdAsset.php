<?php
namespace kordar\ace\web\assets;

/**
 * Configuration for Ace Admin client script files
 */
class EditorMdAsset extends \kordar\editormd\EditorMdAsset
{
    public $depends = [
        'kordar\ace\web\assets\AceAsset'
    ];
}
