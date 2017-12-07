<?php
namespace kordar\ace\widgets;

use Yii;
use kordar\ace\libs\tree\GenerateMenuByTree;
use kordar\ace\libs\tree\GenerateTreeByArray;
use kordar\ace\libs\tree\MenuIterator;
use yii\base\Widget;

class Sidebar extends Widget
{
    public function run()
    {
        $data = \kordar\ace\models\Sidebar::find()->indexBy('id')->orderBy('sort DESC')->asArray()->all();

        $module = Yii::$app->controller->module->id;
        $link = ($module == 'basic') ? implode('/', [Yii::$app->controller->id, Yii::$app->controller->action->id]) : implode('/', [$module, Yii::$app->controller->id, Yii::$app->controller->action->id]);

        $group = new GenerateTreeByArray();

        $tree = $group->tree($data);
        $sideBarTree = new GenerateMenuByTree(new MenuIterator($tree), \RecursiveIteratorIterator::SELF_FIRST);
        $sideBarTree->linker = $link;

        foreach ($sideBarTree as $item) {
            $sideBarTree->sideBarHtml .= $sideBarTree->createNode($item, $sideBarTree->callHasChildren());
        }
        return $this->render('sidebar', ['menu'=>$sideBarTree->sideBarHtml]);
    }

}