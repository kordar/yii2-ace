<?php
namespace kordar\ace\libs;

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

    static public function getGroup($list = array())
    {
        $groups = [];
        foreach ($list as $item) {
            $keyNode = $item['parent_id'];
            $groups[$keyNode][] = $item;
        }
        return $groups;
    }

    static public function tree($list = array())
    {
        $tree = [];
        $groups = self::getGroup($list);
        if (isset($groups[0])) {

        }


        foreach ($groups as $nodeKey => $group) {
            if (empty($group)) {
                continue;
            }

            foreach ($group as $item) {



            }

        }
    }

}