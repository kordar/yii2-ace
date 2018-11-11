<?php
namespace kordar\ace\controllers;

use kordar\upload\AliYunOss;
use kordar\upload\ScsUploadFile;

/**
 * Class DefaultController
 * @package kordar\ace\controllers
 * @item *:网站管理
 */
class DefaultController extends AceController
{
    protected $rbacExcept = ['error'];
    protected $rbacJsonMessageOnly = ['upload'];

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],

            'upload' => [
                'class' => AliYunOss::className(),
                'name' => 'SingleUploadForm[file]',
                'bucket' => 'img-plant',
                'extensions' => 'txt',
                'category' => 'test',
                //'extensions' => 'svga'
            ]

//            'upload' => [
//                'class' => ScsUploadFile::className(),
//                'name' => 'SingleUploadForm[file]',
//                'bucket' => 'res-001',
//                'autoSubDateRoot' => 'Y/m/d'
//            ]
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
