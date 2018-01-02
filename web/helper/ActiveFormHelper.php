<?php
namespace kordar\ace\web\helper;

use yii\helpers\Html;

class ActiveFormHelper
{
    public static function aceRadioListOptions()
    {
        return [
            'class'=>'radio form-control',
            'item' => function ($index, $label, $name, $checked, $value) {
                return Html::radio($name, $checked, array_merge(['class' => 'ace'], [
                    'value' => $value,
                    'label' => Html::tag('span', Html::encode(' ' . $label), ['class'=>'lbl'])
                ]));
            }
        ];
    }

    public static function aceCheckboxListOptions()
    {
        return [
            'item' => function($index, $label, $name, $checked, $value) {
                return Html::checkbox($name, $checked, array_merge(['class' => 'ace ace-checkbox-2'], [
                    'value' => $value,
                    'label' => Html::tag('span', Html::encode(' ' . $label), ['class'=>'lbl'])
                ]));
            }
        ];
    }

    // *********
    public static function extSelectCase($options = [])
    {
        $params = [];
        foreach ($options as $field => $option) {
            $str = '';
            foreach ($option['items'] as $key => $item) {
                $str .= " WHEN $key THEN '$item'";
            }
            $params[] = "(CASE `$field` $str END) AS {$option['alias']}";
        }
        return $params;
    }
}