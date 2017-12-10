<?php
namespace kordar\ace\helper;

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
}