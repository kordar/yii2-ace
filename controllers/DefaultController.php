<?php
namespace kordar\ace\controllers;

use kordar\ace\models\admin\Admin;
use kordar\upload\SingleUploadFile;

/**
 * Default controller for the `ace` module
 * @item *:网站管理
 * @item index:管理首页
 * @item icons:Icon列表
 * @item env:PHP环境
 * @item error:异常页面
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
                'catgory' => 'test',
                'autoSubDateRoot' => 'Y/m/d'
            ]
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

    public function actionEnv()
    {
        $model = new Admin();
        // $model->avatar = '/uploads/2017/12/19/vr0di1u9va1vg1crj695kl1tu3.jpg';
        return $this->render('env', ['model' => $model]);
    }

    public function actionError()
    {
    }

    public function actionDownloadFile($filename)
    {
        $res = \YII::$app->response;
        $res->sendFile($filename);
    }

}
