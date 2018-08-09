<?php
namespace kordar\ace\web\helper;

use Yii;
use yii\helpers\Html;

class GridViewHelper
{
    static public function dropDownListYesOrNo($prompt = '')
    {
        return [0 => Yii::t('ace', 'No'), 1 => Yii::t('ace', 'Yes')];
    }

    static public function actionColumn($options = [])
    {
        $template = implode(' ', array_map(function ($item) {
            return '{' . $item . '}';
        }, $options['template']));

        $buttons = [];
        foreach ($options['template'] as $item) {
            $opt = isset($options['item'][$item]) ? $options['item'][$item] : [];
            $buttons[$item] = call_user_func([GridViewHelper::class, $item . 'Button'], $opt);
        }

        return [
            'header' => isset($options['title']) ? $options['title'] : '',
            'class' => 'yii\grid\ActionColumn',
            'template'=> $template,
            // 'headerOptions' => ['width' => '140'],
            'buttons' => $buttons
        ];
    }

    static public function getUrl($attributes = [], $model, $url, $key)
    {
        $params = [];
        foreach ($attributes as $attribute) {
            $params[$attribute] = $model->$attribute;
        }
        return array_merge([$url, 'id'=>$key], $params);
    }

    static public function deleteButton($options = [])
    {
        return function ($url, $model, $key) use ($options) {
            $options = array_merge([
                'url' => $url, 'key' => $key, 'class' => 'alert-danger', 'title' => 'Grid Delete', 'attribute' => []
            ], $options);
            $url = GridViewHelper::getUrl($options['attribute'], $model, $options['url'], $options['key']);
            return Html::a(Html::tag('span', Yii::t('ace', $options['title'])), $url, ['class' => $options['class'], 'title' => Yii::t('ace', $options['title']),
                'data' => [
                    'confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
                    'method' => 'post'
                ]
            ]);
        };
    }

    static public function updateButton($options = [])
    {
        return function ($url, $model, $key) use ($options) {
            $options = array_merge([
                'url' => $url, 'key' => $key, 'class' => 'alert-info', 'title' => 'Grid Update', 'attribute' => []
            ], $options);
            $url = GridViewHelper::getUrl($options['attribute'], $model, $options['url'], $options['key']);
            return Html::a(Html::tag('span', Yii::t('ace', $options['title'])), $url, ['class' => $options['class'], 'title' => Yii::t('ace', $options['title'])]);
        };
    }

    static public function viewButton($options = [])
    {
        return function($url, $model, $key) use($options) {
            $options = array_merge([
                'url' => $url, 'key' => $key, 'class' => 'alert-success', 'title' => 'Grid View', 'attribute' => []
            ], $options);
            $url = GridViewHelper::getUrl($options['attribute'], $model, $options['url'], $options['key']);
            return Html::a(Html::tag('span', Yii::t('ace', $options['title'])), $url, ['class' => $options['class'], 'title' => Yii::t('ace', $options['title'])]);
        };
    }


    static public function assignButton($options = [])
    {
        return function($url, $model, $key) use($options) {
            $options = array_merge([
                'url' => $url, 'key' => $key, 'class' => 'alert-warning', 'title' => 'Grid Assign', 'attribute' => []
            ], $options);
            $url = GridViewHelper::getUrl($options['attribute'], $model, $options['url'], $options['key']);
            return Html::a(Html::tag('span', Yii::t('ace', $options['title'])), $url, ['class' => $options['class'], 'title' => Yii::t('ace', $options['title'])]);
        };
    }

    static public function button($options = [])
    {
        return function($url, $model, $key) use($options) {
            $options = array_merge([
                'url' => $url, 'key' => $key, 'class' => 'alert-success', 'title' => 'Grid Button', 'attribute' => []
            ], $options);
            $url = GridViewHelper::getUrl($options['attribute'], $model, $options['url'], $options['key']);
            return Html::a(Html::tag('span', Yii::t('ace', $options['title'])), $url, ['class' => $options['class'], 'title' => Yii::t('ace', $options['title'])]);
        };
    }

    static public function __callStatic($name, $arguments)
    {
        return GridViewHelper::button($arguments[0]);
    }

}