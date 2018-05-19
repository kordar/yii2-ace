<?php
namespace kordar\ace\web\widgets\boxes;

use yii\base\Widget;
use yii\helpers\Html;

class Tab extends Widget
{
    /**
     * @var array
     */
    public $data = [];

    /**
     * @var string
     */
    public $theme = '';

    /**
     * @var string
     */
    public $navClass = '';

    /**
     * @var string
     */
    public $template = '{tabs}{content}';

    protected $contentHtml = '';

    public function run()
    {
        return Html::tag('div', strtr($this->template, [
            '{tabs}' => $this->renderTabHtml($this->data), '{content}' => $this->renderContentHtml()
        ]), ['class'=>'tabbable ' . $this->theme]);
    }

    protected function renderContentHtml()
    {
        return Html::tag('div', $this->contentHtml, ['class'=>'tab-content']);
    }

    protected function renderTabHtml($data)
    {
        return Html::ul($data, ['item' => function($item) {

            if (!empty($item['children'])) {

                $active = (isset($item['active']) && $item['active'] === true) ? 'active' : '';

                return Html::tag('li',
                    Html::a($item['title'] . ' <i class="ace-icon fa fa-caret-down bigger-110 width-auto"></i>', '#', ['class'=>'dropdown-toggle', 'data-toggle'=>'dropdown']) .
                    $this->renderChildrenItem($item['children'], empty($item['theme'])?'dropdown-default':$item['theme'])
                    , ['class'=>'dropdown ' . $active]);
            }

            if (isset($item['active']) && $item['active'] === true) {
                return $this->renderActiveItem($item['id'], $item['title'], $item['content']);
            }
            return $this->renderItem($item['id'], $item['title'], $item['content']);
        }, 'class'=>'nav nav-tabs ' . $this->navClass]);
    }

    protected function renderActiveItem($id, $title, $content)
    {
        $this->contentHtml .= Html::tag('div', $content, ['class'=>'tab-pane fade in active', 'id'=>$id]);
        return Html::tag('li', Html::a($title, '#' . $id, ['data-toggle'=>"tab"]), ['class'=>'active']);
    }

    protected function renderItem($id, $title, $content)
    {
        $this->contentHtml .= Html::tag('div', $content, ['class'=>'tab-pane fade', 'id'=>$id]);
        return Html::tag('li', Html::a($title, '#' . $id, ['data-toggle'=>"tab"]));
    }

    protected function renderChildrenItem($children = [], $theme)
    {
        return Html::ul($children, ['item' => function($item, $index) {
            if (isset($item['active']) && $item['active'] === true) {
                return $this->renderActiveItem($item['id'], $item['title'], $item['content']);
            }
            return $this->renderItem($item['id'], $item['title'], $item['content']);
        }, 'class'=>'dropdown-menu ' . $theme]);
    }

}