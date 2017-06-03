<?php
namespace kordar\ace\widgets;

use yii\base\Widget;
use yii\helpers\Html;

class Sidebar extends Widget
{
    public $tree = [];

    public function run()
    {
        $obj = new \kordar\ace\tree\ArrayToTree($this->tree);

        $sideBarTree = new SidebarSplTree(new \kordar\ace\tree\MenuIterator($obj->tree), \RecursiveIteratorIterator::SELF_FIRST);
        foreach ($sideBarTree as $item) {
            $sideBarTree->sideBarHtml .= $sideBarTree->createNode($item, $sideBarTree->callHasChildren());
        }
        return $this->render('sidebar', ['menu'=>$sideBarTree->sideBarHtml]);
    }

}


class SidebarSplTree extends \RecursiveIteratorIterator
{
    public $sideBarHtml = '';

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
        $li = $node['active']?'<li class="active">':'<li>';
        if ($isChildren) {
            $a = Html::a("<i class=\"menu-icon fa {$node['icon']}\"></i><span class=\"menu-text\"> {$node['title']} </span><b class=\"arrow fa fa-angle-down\"></b>", $node['href'],
                ['class'=>'dropdown-toggle', 'data-active'=>$node['href']]);
            return $li . $a . "<b class=\"arrow\"></b>";
        } else {
            $a = Html::a("<i class=\"menu-icon fa {$node['icon']}\"></i><span class=\"menu-text\"> {$node['title']} </span>",$node['href'],
                ['data-active'=>$node['href']]);
            return $li . $a . "<b class=\"arrow\"></b></li>";
        }
    }

}