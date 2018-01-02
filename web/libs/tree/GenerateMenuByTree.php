<?php
namespace kordar\ace\web\libs\tree;

use yii\helpers\Html;

class GenerateMenuByTree extends \RecursiveIteratorIterator
{
    public $sideBarHtml = '';

    public $linker = '';

    public function beginIteration()
    {
        $this->sideBarHtml .= "<ul class='nav nav-list'>\n";
    }

    public function beginChildren()
    {
        $this->sideBarHtml .= "<ul class='submenu'>\n";
    }

    public function endChildren()
    {
        $this->sideBarHtml .= "</ul></li>\n";
    }

    public function endIteration()
    {
        $this->sideBarHtml .= "</ul>\n";
    }

    public function createNode($node = [], $isChildren = false)
    {
        /*if ($node['active'] == 1 && isset($node['open']) && $node['open']) {
            $li = '<li class="active open">';
        } elseif ($node['active'] == 1) {
            $li = '<li class="active">';
        } else {
            $li = '<li>';
        }*/

        if ($node['href'] == $this->linker) {
            $li = '<li class="active">';
        } else {
            $li = '<li>';
        }

        if ($isChildren) {
            $a = Html::a("<i class=\"menu-icon fa {$node['icon']}\"></i><span class=\"menu-text\"> {$node['title']} </span><b class=\"arrow fa fa-angle-down\"></b>", ['/' . $node['href']], ['class'=>'dropdown-toggle']);
            return $li . $a . "<b class=\"arrow\"></b>";
        } else {
            $a = Html::a("<i class=\"menu-icon fa {$node['icon']}\"></i><span class=\"menu-text\"> {$node['title']} </span>",['/' . $node['href']]);
            return $li . $a . "<b class=\"arrow\"></b></li>";
        }
    }

}