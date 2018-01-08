<?php
namespace kordar\ace\controllers;

use kordar\upload\SingleUploadFile;

/**
 * Class DefaultController
 * @package kordar\ace\controllers
 * @item *:网站管理
 */
class DefaultController extends AceController
{
    protected $rbacExcept = ['error'];

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'upload' => [
                'class' => SingleUploadFile::className(),
                'category' => 'test',
                'autoSubDateRoot' => 'Y/m/d'
            ]
        ];
    }

    /**
     * Renders the index view for the module
     * @return string
     * @item index:网站首页
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Error Page
     * @item error:异常页面
     */
    // public function actionError() {}

}
