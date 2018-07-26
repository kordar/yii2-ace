<?php
namespace kordar\ace\web\helper;



use kordar\ace\models\menu\Menu;
use yii\helpers\ArrayHelper;

class SidebarHelper
{

    static public function getSidebarDropDownList($top = '')
    {
        return ArrayHelper::merge([0 => $top], Menu::setSidebarList());
    }

    static public function getTree()
    {
        return Menu::sidebarTree();
    }

    public static function linker()
    {
        return (\Yii::$app->controller->module->id == \Yii::$app->id) ?
            \Yii::$app->controller->id . '/' . \Yii::$app->controller->action->id :
            \Yii::$app->controller->module->id . '/' . \Yii::$app->controller->id . '/' . \Yii::$app->controller->action->id;
    }

}