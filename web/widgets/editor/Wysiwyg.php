<?php
namespace kordar\ace\web\widgets\editor;

use kordar\ace\web\assets\WysiwygAsset;
use kordar\ace\web\helper\WidgetHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\InputWidget;

class Wysiwyg extends InputWidget
{
    public $url;
    public $type = 1;

    public function init()
    {
        parent::init();
        WysiwygAsset::register($this->view);
        echo Html::activeTextarea($this->model, $this->attribute, ['id' => $this->options['id'] . '-textarea', 'class' => 'hidden']);
        echo Html::tag('div', '', ['class'=>'wysiwyg-editor', 'id'=>$this->options['id']]);
        $js = $this->editorJs();
        $this->view->registerJs($js);
        $js = sprintf('$("#%s").blur(function(){$("#%s").val($(this).html())})', $this->options['id'], $this->options['id'] . '-textarea');
        $this->view->registerJs($js);
    }

    protected function editorJs()
    {
        $url = $this->url ? : Url::to(['upload']);

        $toolbarOptions = WidgetHelper::wysiwygOptions([
            ['name' => 'font'],
            null,
            ['name' => 'fontSize'],
            null,
            ['name' => 'bold', 'className' => 'btn-info'],
            ['name' => 'italic', 'className'=>'btn-info'],
            ['name' => 'strikethrough', 'className'=>'btn-info'],
            ['name' => 'underline', 'className'=>'btn-info'],
            null,
            ['name' => 'insertunorderedlist', 'className'=>'btn-info'],
            ['name' => 'insertorderedlist', 'className'=>'btn-info'],
            ['name' => 'outdent', 'className'=>'btn-info'],
            ['name' => 'indent', 'className'=>'btn-info'],
            null,
            ['name' => 'justifyleft', 'className'=>'btn-primary'],
            ['name' => 'justifycenter', 'className'=>'btn-primary'],
            ['name' => 'justifyright', 'className'=>'btn-primary'],
            ['name' => 'justifyfull', 'className'=>'btn-inverse'],
            null,
            ['name' => 'createLink', 'className'=>'btn-pink'],
            ['name' => 'unlink', 'className'=>'btn-pink'],
            null,
            ['name' => 'insertImage', 'className'=>'btn-success'],
            null,
            ['name' => 'foreColor'],
            null,
            ['name' => 'undo', 'className'=>'btn-grey'],
            ['name' => 'redo', 'className'=>'btn-grey'],
        ]);

        $wysiwygOptions = WidgetHelper::getOptions([
            'fileUploadError' => 'function (reason, detail) {
                var msg=\'\';
                if (reason===\'unsupported-file-type\') { msg = "Unsupported format " + detail; }
                else {
                    // console.log("error uploading file", reason, detail);
                }
                $(\'<div class="alert"> <button type="button" class="close" data-dismiss="alert">&times;</button>\'+ 
                 \'<strong>File upload error</strong> \' + msg + \' </div>\').prependTo(\'#alerts\');
            }',
            'readFileIntoDataUrl' => WidgetHelper::callbackWysiwygJs($this->options['id'], $url)
        ]);

        return WidgetHelper::wysiwygJs($this->options['id'], $toolbarOptions, $wysiwygOptions, 'wysiwyg-style' . $this->type);
    }

}