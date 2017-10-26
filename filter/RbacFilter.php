<?php
namespace kordar\ace\filter;

use Yii;
use yii\base\ActionFilter;
use yii\web\HttpException;

class RbacFilter extends ActionFilter
{

    public function beforeAction($action)
    {
        if (!parent::beforeAction($action)) {
            return false;
        }

        $module = $action->controller->module->id;
        $controller = $action->controller->id;
        $actionName = $action->id;

        $prefix = $module == 'basic' ? $controller : $module . '/' . $controller;

        $userId = \Yii::$app->user->identity->getId();
        $auth = \Yii::$app->authManager;
        $data = $auth->getPermissionsByUser($userId);

        Yii::$app->params['authKeys'] = array_keys($data);

        if (Yii::$app->user->can($prefix . '/*')) {
            return true;
        }
        if (Yii::$app->user->can($prefix . '/'. $actionName)) {
            return true;
        }
        throw new HttpException(503, '对不起，您没有访问'. $module . '/' . $controller. '/'. $actionName. '的权限');
    }

}