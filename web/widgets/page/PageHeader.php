<?php
namespace kordar\ace\web\widgets\page;

use yii\base\Widget;
use yii\helpers\Html;

class PageHeader extends Widget
{
    /**
     * @var string
     */
    public $title = '';

    /**
     * @var string
     */
    public $small = '';

    public function run()
    {
        echo Html::tag('div', Html::tag('h1', $this->title . ' <small><i class="ace-icon fa fa-angle-double-right"></i> ' . $this->small . '</small>'), ['class' => 'page-header']);
    }
}