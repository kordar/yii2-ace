<?php

namespace kordar\ace\controllers;

use kordar\ace\models\admin\EditForm;
use kordar\ace\models\admin\SignupForm;
use Yii;
use kordar\ace\models\admin\Assignment;
use kordar\ace\models\admin\Admin;
use kordar\ace\models\admin\AdminSearch;
use yii\web\NotFoundHttpException;

/**
 * AdminController implements the CRUD actions for Admin model.
 * @item *:管理员管理
 * @item create:创建管理员
 * @item delete:删除管理员
 * @item update:更新管理员
 * @item index:管理员列表
 * @item view:管理员详情
 * @item assign:角色分配
 */
class AdminController extends AceController
{

    /**
     * Lists all Admin models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AdminSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Admin model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $extSelect = [
            "(CASE `status` WHEN 0 THEN '" . Yii::t('ace.admin', 'Delete') . "' WHEN 10 THEN '" . Yii::t('ace.admin', 'Normal') . "' END) AS status_name",
            "(CASE `type` WHEN 0 THEN '" . Yii::t('ace.admin', 'Normal Admin') . "' WHEN 9 THEN '" . Yii::t('ace.admin', 'Super Admin') . "' END) AS type_name",
        ];

        return $this->render('view', [
            'model' => Admin::find()->select('*')->addSelect($extSelect)->where(['id'=>$id])->one()
        ]);
    }

    /**
     * Creates a new Admin model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new SignupForm();

        if ($model->load(Yii::$app->request->post()) && $user = $model->signup()) {
            return $this->redirect(['view', 'id' => $user->id]);
        }

        return $this->render('create', ['model' => $model]);
    }

    /**
     * Updates an existing Admin model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = EditForm::findOne($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    // 授权
    public function actionAssign($id, $name)
    {
        $model = new Assignment();

        if (Yii::$app->request->isPost) {

            $model->roles = Yii::$app->request->post('roles', []);
            $model->permissions = Yii::$app->request->post('permissions', []);
            if ($model->setAssignment($id)) {
                return $this->redirect(['index']);
            }
        }

        return $this->render('assign', [
            'model' => $model,
            'roles' => $model->roles($id),
            'permissions' => $model->permissions($id),
            'name' => $name
        ]);
    }

    /**
     * Deletes an existing Admin model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Admin model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Admin the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Admin::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
