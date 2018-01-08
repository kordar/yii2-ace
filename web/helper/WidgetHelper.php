<?php
namespace kordar\ace\web\helper;

class WidgetHelper
{
    public static function inputJs($id, $options = [], $change = '')
    {
        $str = WidgetHelper::getOptions($options);
        return "$('#" . $id . "').ace_file_input({" . $str . "}).on('change', function() {" . $change . "})";
    }

    public static function showInputJs($id, $value)
    {
        return empty($value) ? null : "\$('#{$id}').ace_file_input('show_file_list', ['{$value}'])";
    }

    public static function showWellJs($id, $value)
    {
        return empty($value)? null : "\$(\"#{$id}\").ace_file_input(\"show_file_list\",[{type:\"image\",name:\"{name}\",path:\"{path}\"}]);";
    }

    public static function getOptions($options = [])
    {
        $opt = [];
        foreach ($options as $key => $val) {

            if ($val === null) {
                $opt[] = "$key: null";
                continue;
            }

            switch (true) {
                case is_string($val):
                    $opt[] = strpos($val, 'function') === false ? "$key: \"$val\"" : "$key: $val";
                    break;
                case is_bool($val):
                    $opt[] = $val ? "$key: true" : "$key: false";
                    break;
                case is_numeric($val):
                    $opt[] = "$key: $val";
                    break;
            }
        }
        return implode(',', $opt);
    }

    public static function callbackJs($id, $url)
    {
        $label = [
            'warning' => \Yii::t('ace.upload','Warning'),
            'browser_does_not_support' => \Yii::t('ace.upload', 'Browser does not support'),
        ];
        $js = 'if(window.FormData){var formData=new FormData();formData.append("SingleUploadForm[file]",document.getElementById("{id}").files[0]);formData.append("filename",document.getElementById("{hiddenId}").value);var xhr=new XMLHttpRequest();xhr.open("POST","{url}");xhr.onload=function(){if(xhr.status===200){var json=$.parseJSON(xhr.responseText);if(json.status==="success"){var path=json.path;$("#{hiddenId}").val(path);return}}bootboxWarning(json.msg,"{label-warning}")};xhr.send(formData)}else{bootboxWarning("{label-browser-does-not-support}","{label-warning}")};';
        return str_replace(['{id}', '{hiddenId}', '{url}', '{label-warning}', '{label-browser-does-not-support}'], [
            $id, $id . '-hidden', $url, $label['warning'], $label['browser_does_not_support']
        ], $js);
    }

    public static function callbackWysiwygJs($id, $url)
    {
        $label = [
            'warning' => \Yii::t('ace.upload','Warning'),
            'browser_does_not_support' => \Yii::t('ace.upload', 'Browser does not support'),
        ];
        $js = 'function(fileinfo){var img="";if(window.FormData){var formData=new FormData();formData.append("SingleUploadForm[file]",fileinfo);var xhr=new XMLHttpRequest();xhr.open("POST","{url}",false);xhr.onload=function(){if(xhr.status===200){var json=$.parseJSON(xhr.responseText);if(json.status==="success"){img=json.path;return}}bootboxWarning(json.msg,"{label-warning}")};xhr.send(formData)}else{bootboxWarning("{label-browser-does-not-support}","{label-warning}")}return img;}';
        return str_replace(['{id}', '{url}', '{label-warning}', '{label-browser-does-not-support}'], [
            $id, $url, $label['warning'], $label['browser_does_not_support']
        ], $js);
    }

    public static function wysiwygOptions($options = [])
    {
        $opts = [];
        foreach ($options as $val) {

            if ($val === null) {
                $opts[] = 'null';
                continue;
            }

            if (isset($val['className'])) {
                $opts[] = '{name:"' . $val['name'] . '", className:"' . $val['className'] . '"}';
            } else {
                $opts[] = '{name:"' . $val['name'] . '"}';
            }
        }
        return implode(',', $opts);
    }

    public static function wysiwygJs($id, $toolbar = '', $wysiwyg = '', $style = '')
    {
        return str_replace(['{id}', '{toolbar}', '{wysiwyg}', '{style}'], [$id, $toolbar, $wysiwyg, $style],
            '$(\'#{id}\').ace_wysiwyg({toolbar:[{toolbar}],\'wysiwyg\':{{wysiwyg}}}).prev().addClass(\'{style}\')');
    }
}