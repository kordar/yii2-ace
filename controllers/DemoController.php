<?php
namespace kordar\ace\controllers;

use kordar\upload\SingleUploadFile;
use yii\web\Controller;

/**
 * Class DefaultController
 * @package kordar\ace\controllers
 */
class DemoController extends Controller
{
    public function actions()
    {
        return [];
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
