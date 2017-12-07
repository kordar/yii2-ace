<?php
namespace kordar\ace\widgets;

use BlueM\Tree;
use kordar\ace\libs\GenerateTreeByArray;
use yii\base\Widget;
use yii\helpers\Html;

class Sidebar extends Widget
{
    public $tree = [];

    public function run()
    {
        $this->tree = \kordar\ace\models\Sidebar::find()->indexBy('id')->orderBy('sort DESC')->asArray()->all();

        $group = GenerateTreeByArray::getGroup($this->tree);
        var_dump($group);die;

        $obj = new \kordar\ace\libs\tree\ArrayToTree($this->tree);

        $sideBarTree = new SidebarSplTree(new \kordar\ace\libs\tree\MenuIterator($obj->tree), \RecursiveIteratorIterator::SELF_FIRST);
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
        if ($node['active'] == 1 && isset($node['open']) && $node['open']) {
            $li = '<li class="active open">';
        } elseif ($node['active'] == 1) {
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