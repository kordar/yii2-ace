<?php
namespace kordar\ace\widgets;

use Yii;
use kordar\ace\libs\tree\GenerateMenuByTree;
use kordar\ace\libs\tree\MenuIterator;
use yii\base\Widget;

class Sidebar extends Widget
{
    public $link = '';
    public $tree = [];

    public function run()
    {
        $sideBarTree = new GenerateMenuByTree(new MenuIterator($this->tree), \RecursiveIteratorIterator::SELF_FIRST);

        $sideBarTree->linker = $this->link;

        foreach ($sideBarTree as $item) {
            $sideBarTree->sideBarHtml .= $sideBarTree->createNode($item, $sideBarTree->callHasChildren());
        }
        return $this->render('sidebar', ['menu'=>$sideBarTree->sideBarHtml]);
    }

}