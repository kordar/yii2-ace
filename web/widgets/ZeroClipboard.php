<?php
namespace kordar\ace\web\widgets;

use yii\base\Widget;
use kordar\ace\web\assets\ZeroClipboardAsset;

class ZeroClipboard extends Widget
{
    public $items = [];

    public function run()
    {
        $assetObj = ZeroClipboardAsset::register($this->view);
        $path = $assetObj->baseUrl . '/ZeroClipboard.swf';

        $js = '';
        foreach ($this->items as $key => $item) {
            $js .= '$(\'' . $key . '\').zclip({path: \'' . $path . '\', copy: function(){return \'' . $item . '\'; }});';
        }

        $this->view->registerJs($js);
        return true;
    }
}