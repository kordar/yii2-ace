<?php
namespace kordar\ace\libs\tree;

use Yii;

class ArrayToTree
{
    /**
     * @var array
     * $levelTree = [
     *      LEVEL_0 => [ITEM_0, ITEM_1, ITEM_2, ...],
     *      LEVEL_1 => [ITEM_0, ITEM_1, ITEM_2, ...],
     *      LEVEL_2 => [ITEM_0, ITEM_1, ITEM_2, ...],
     *      ......
     * ]
     */
    private $levelTree = [];

    private $parentKey = '';

    public function __construct($arr = [], $parentKey = 'parent_id')
    {
        $this->parentKey = $parentKey;

        if ($arr) {

            $link = implode('/', [
                Yii::$app->controller->module->id,
                Yii::$app->controller->id,
                Yii::$app->controller->action->id
            ]);

            $defaultActiveID = array_search(1, array_column($arr, 'active', 'id'));

            $activeID = array_search($link, array_column($arr, 'href', 'id'));

            if ($activeID && $activeID != $defaultActiveID) {
                $arr[$defaultActiveID]['active'] = '0';
            } else {
                $activeID = $defaultActiveID;
            }

            if ($activeID === false) {
                $top = current($arr);
                $activeID = $top['id'];
            }

            $this->setParentActive($arr, $activeID);

            foreach ($arr as $item) {
                if (isset($item['hidden']) && $item['hidden'] == 0) {

                    if (empty($item['href'])) {
                        $this->levelTree[$item[$parentKey]][] = $item;
                        continue;
                    }

                    foreach (Yii::$app->params['authKeys'] as $param) {
                        if ($param == $item['href']) {
                            $this->levelTree[$item[$parentKey]][] = $item;
                            continue;
                        }
                    }
                }
            }
            $this->tree = $this->generateTree($this->levelTree[0]);
        }

    }

    private function setParentActive(&$arr, $current)
    {
        $arr[$current]['active'] = '1';
        $parentID = $arr[$current][$this->parentKey];
        if ($parentID && isset($arr[$parentID])) {
            $arr[$parentID]['open'] = $arr[$current]['hidden'] == 0 ? true : false;
            $this->setParentActive($arr, $arr[$parentID]['id']);
        }
        return true;
    }

    public $tree = [];

    private function generateTree($levelsNode = [])
    {
        $root = [];
        foreach ($levelsNode as $key => $node) {
            $root[$key] = $node;
            $nodeID = $node['id'];
            if (isset($this->levelTree[$nodeID])) {
                $children = $this->generateTree($this->levelTree[$nodeID]);
                $root[$key]['children'] = $children;
            }
        }
        return $root;
    }

}