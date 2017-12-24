<?php
namespace kordar\ace\web\filter;

use Yii;
use yii\base\ActionFilter;
use yii\web\HttpException;

class RbacFilter extends ActionFilter
{
    public $except = [];

    public function beforeAction($action)
    {
        if (!parent::beforeAction($action)) {
            return false;
        }

        $actionName = $action->id;

        if (in_array($actionName, $this->except)) {
            return true;
        }

        $module = $action->controller->module->id;
        $controller = $action->controller->id;


        $prefix = $module == 'basic' ? $controller : $module . '/' . $controller;

        if ($this->setAuthKey()) {
            return true;
        }

        if (Yii::$app->user->can($prefix . '/*')) {
            return true;
        }
        if (Yii::$app->user->can($prefix . '/'. $actionName)) {
            return true;
        }

        throw new HttpException(503, '对不起，您没有访问'. $module . '/' . $controller. '/'. $actionName. '的权限');
    }

    protected function setAuthKey()
    {
        if (Yii::$app->user->identity !== null) {
            $userId = Yii::$app->user->identity->getId();
            $auth = Yii::$app->authManager;

            if (Yii::$app->user->identity->super()) {
                $data = $auth->getPermissions();
                Yii::$app->params['authKeys'] = array_keys($data);
                return true;
            } else {
                $data = $auth->getPermissionsByUser($userId);
                Yii::$app->params['authKeys'] = array_keys($data);
            }
        }

        return false;
    }

}