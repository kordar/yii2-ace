<?php
namespace kordar\ace\helper;

use Yii;
use yii\helpers\Html;

class DetailViewHelper
{
    static public function fontAwesomeIcon($icons = '', $attribute = 'icon', $format = 'raw')
    {
        return [
            'attribute' => $attribute,
            'format' => $format,
            'value' => Html::tag('i', '', ['class'=>'fa ' . $icons])
        ];
    }

    static public function status($state = 0, $attribute = 'active', $format = 'raw')
    {
        $active = ['0' => Yii::t('ace', 'Not Activated'), '1' => Yii::t('ace', 'Activating')];
        return [
            'attribute' => $attribute,
            'format' => $format,
            'value' => Html::tag('i', $active[$state], ['class' => $state ? 'text-success' : 'text-danger'])
        ];
    }

    static public function active($state = 0, $attribute = 'active', $format = 'raw')
    {
        $active = ['0' => Yii::t('ace', 'No'), '1' => Yii::t('ace', 'Yes')];
        return [
            'attribute' => $attribute,
            'format' => $format,
            'value' => Html::tag('i', $active[$state], ['class' => $state ? 'text-success' : 'text-danger'])
        ];
    }
}