<?php
namespace kordar\ace\web\filter;

use yii\base\ActionFilter;
use yii\web\HttpException;

class RbacFilter extends ActionFilter
{
    public $jsonMessageOnly = [];

    public function beforeAction($action)
    {
        if ($this->isActive($action)) {

            $user = \Yii::$app->user;

            if ($user !== null && $user->getIsGuest()) {
                $user->loginRequired();
                return false;
            }

            if ($user->identity->super()) {
                return true;
            }

            return $this->canPass($action->controller->module->id, $action->controller->id, $action->id);
        }

        return true;
    }

    private function canPass($module, $controller, $action)
    {
        $prefix = $module == \Yii::$app->id ? $controller : $module . '/' . $controller;

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