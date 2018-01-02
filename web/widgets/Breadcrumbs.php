<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace kordar\ace\web\widgets;

use yii\base\InvalidConfigException;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

class Breadcrumbs extends \yii\widgets\Breadcrumbs
{
    protected function renderItem($link, $template)
    {
        $encodeLabel = ArrayHelper::remove($link, 'encode', $this->encodeLabels);
        $i = array_key_exists('icon', $link) ? Html::tag('i', '', ['class'=>'ace-icon fa ' . $link['icon']]) : '';
        if (array_key_exists('label', $link)) {
            $label = $encodeLabel ? Html::encode($link['label']) : $link['label'];
        } else {
            throw new InvalidConfigException('The "label" element is required for each link.');
        }
        if (isset($link['template'])) {
            $template = $link['template'];
        }
        if (isset($link['url'])) {
            $options = $link;
            unset($options['template'], $options['label'], $options['url'], $options['icon']);
            $link = Html::a($label, $link['url'], $options);
        } else {
            $link = $label;
        }
        return strtr($template, ['{link}' => $link, '{i}' => $i]);
    }
}
