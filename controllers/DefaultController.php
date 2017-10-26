<?php
namespace kordar\ace\controllers;


/**
 * Default controller for the `ace` module
 * @item *:网站管理
 * @item index:管理首页
 * @item icons:Icon列表
 * @item error:异常页面
 */
class DefaultController extends AceController
{

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionIcons()
    {
        return $this->render('icons');
    }

    public function actionError()
    {
    }

}
