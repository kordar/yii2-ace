<?php
namespace kordar\ace\libs\tree;

class GenerateTreeByArray
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

    protected $groups = [];

    protected function setGroup($list = array())
    {
        foreach ($list as $item) {
            if ($item['hidden'] == 0) {
                $keyNode = $item['parent_id'];
                $this->groups[$keyNode][] = $item;
            }
        }
    }

    public function tree($list = [], $options = [])
    {
        $this->setGroup($list);
        $rootKey = isset($options['rootKey']) ? $options['rootKey'] : 0;
        $tree = [];

        if (isset($this->groups[$rootKey])) {
            $rootNodes = $this->groups[$rootKey];
            $tree = $this->generateTree($rootNodes);
        }

        return $tree;
    }

    // 生成树
    protected function generateTree($levelsNode = [])
    {
        $root = [];
        foreach ($levelsNode as $key => $node) {
            $root[$key] = $node;
            $nodeID = $node['id'];
            if (isset($this->groups[$nodeID])) {
                $children = $this->generateTree($this->groups[$nodeID]);
                $root[$key]['children'] = $children;
            }
        }
        return $root;
    }
}