<?php
namespace kordar\ace\web\libs;

class ItemsToGroup extends \ArrayIterator
{
    private $callback;

    public function __construct($value, $callback)
    {
        parent::__construct($value);
        $this->callback = $callback;
    }

    public $group = '';

    public function key()
    {
        $this->group = call_user_func($this->callback, parent::key());
        return parent::key();
    }
}