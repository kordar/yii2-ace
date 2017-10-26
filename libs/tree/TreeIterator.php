<?php
namespace kordar\ace\libs\tree;

class TreeIterator extends \RecursiveTreeIterator
{
    public function callHasChildren()
    {
        $current = $this->current();
        print_r($current);
        return is_array($current);
        // TODO: Implement hasChildren() method.
    }
}