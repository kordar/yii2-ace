<?php
namespace kordar\ace\web\assets\plugins\form;

use kordar\ace\web\assets\AceBundleAsset;

class MarkdownAsset extends AceBundleAsset
{
    public $js = [
        'js/markdown.min.js',
        'js/bootstrap-markdown.min.js'
    ];

    public $depends = [
        'kordar\ace\web\assets\plugins\JqueryUIAsset'
    ];
}