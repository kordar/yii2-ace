<?php
namespace kordar\ace\web\filter;

use yii\base\ActionFilter;
use yii\web\HttpException;

class RbacFilter extends ActionFilter
{
    public $jsonMessageOnly = [];

    public function beforeAction($action)
    {
        if (!parent::beforeAction($action)) {
            return false;
        }

        if (in_array($action->id, $this->except) || $this->isSuper()) {
            return true;
        }

        return $this->canPass($action->controller->module->id, $action->controller->id, $action->id);
    }

    private function setAuthKey($userId, $super = false)
    {
        $auth = \Yii::$app->authManager;
        $data = ($super === false) ? $auth->getPermissionsByUser($userId) : $auth->getPermissions();
        \Yii::$app->params['authKeys'] = array_keys($data);
        return true;
    }

    private function isSuper()
    {
        /**
         * @var \kordar\ace\models\admin\Admin $identity
         */
        $identity = \Yii::$app->user->identity;
        $super = ($identity !== null) ? $identity->super() : false;
        $this->setAuthKey($identity->getId(), $super);
        return $super;
    }

    private function canPass($module, $controller, $action)
    {
        $prefix = $module == 'basic' ? $controller : $module . '/' . $controller;

        if (\Yii::$app->user->can($prefix . '/*') || \Yii::$app->user->can($prefix . '/'. $action)) {
            return true;
        } else {

            if (in_array($action, $this->jsonMessageOnly)) {
                $response = \Yii::$app->response;
                $response->format = \yii\web\Response::FORMAT_JSON;
                $response->data = ['status' => 202, 'msg' => '访问受限!'];
                $response->send();
                exit();
            }

            throw new HttpException(503, \Yii::t('ace', 'Sorry, you do not have permission to access this page!'));
        }
    }

}