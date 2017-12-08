<?php
namespace kordar\ace\helper;

use Yii;
use kordar\ace\libs\inter\EventInterface;

class SidebarHelper implements EventInterface
{
    static public function setTree($tree = [])
    {
        RedisHelper::$database = 10;
        $key = EventInterface::USER_SIDEBAR_REDIS_KEY;
        return RedisHelper::setEx($key, EventInterface::USER_SIDEBAR_REDIS_KEY_TIMEOUT, serialize($tree));
    }

    static public function getTree()
    {
        RedisHelper::$database = 10;
        $data = RedisHelper::get(EventInterface::USER_SIDEBAR_REDIS_KEY);
        return empty($data) ? [] : unserialize($data);
    }

    static public function linker()
    {
        $id = Yii::$app->id;
        $module = Yii::$app->controller->module->id;
        $controller = Yii::$app->controller->id;
        $action = Yii::$app->controller->action->id;
        $routes = ($module == $id) ? [$controller, $action] : [$module, $controller, $action];
        return implode('/', $routes);
    }

}