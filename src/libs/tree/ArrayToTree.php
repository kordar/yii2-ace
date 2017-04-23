<?php
namespace kordar\ace\libs\tree;

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
            foreach ($arr as $item) {
                $this->levelTree[$item[$parentKey]][] = $item;
            }
        }
        $this->tree = $this->generateTree($this->levelTree[0]);
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