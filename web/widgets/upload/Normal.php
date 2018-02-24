<?php
namespace kordar\ace\web\widgets\upload;

use kordar\ace\web\assets\UploadAsset;
use kordar\ace\web\helper\WidgetHelper;
use yii\helpers\Url;
use yii\widgets\InputWidget;
use yii\helpers\Html;

class Normal extends InputWidget
{
    /**
     * @var string
     * Url
     */
    public $url = '';

    /**
     * @var string
     * Title
     */
    public $title = 'Title';

    public function init()
    {
        parent::init(); // TODO: Change the autogenerated stub
        UploadAsset::register($this->view);
        echo Html::activeHiddenInput($this->model, $this->attribute, ['id'=>'kordar-upload-hidden'])
            . Html::activeInput('file', $this->model, $this->attribute);
    }

    public function run()
    {
        $url = $this->url ? : Url::to(['upload']);
        $js = WidgetHelper::inputJs($this->options['id'], [
                  "no_file" => \Yii::t('ace.upload','No File ...'),
               "btn_choose" => \Yii::t('ace.upload','Choose'),
               "btn_change" => \Yii::t('ace.upload','Change'),
                "droppable" => false,
                "thumbnail" => false,
            "before_remove" => 'function() {
                                    $(\'#kordar-upload-hidden\').val(\'\');
                                    return true;
                                }'
        ], WidgetHelper::callbackJs($this->options['id'], $url, 'function(json) {
                if (json.status === 200) {
                    $(\'#kordar-upload-hidden\').val(json.path);
                } else {
                    bootbox.alert(json.msg);
                }
            }', 'function() {return $(\'#kordar-upload-hidden\').val();}'));
        $this->view->registerJs($js);
        $attribute = $this->attribute;
        $showJs = WidgetHelper::showInputJs($this->options['id'], $this->model->$attribute);
        if ($showJs !== null) {
            $this->view->registerJs($showJs);
        }
    }
}