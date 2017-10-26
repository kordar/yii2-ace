<?php

namespace kordar\ace\modules\rbac\controllers;

use kordar\ace\modules\rbac\models\Role;
use Yii;
use kordar\ace\controllers\AceController;
use kordar\ace\modules\rbac\models\AuthItem;
use kordar\ace\modules\rbac\models\AuthItemSearch;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * @item *:角色管理
 * @item create:创建角色
 * @item delete:删除角色
 * @item update:更新角色
 * @item index:角色列表
 * @item view:角色详情
 * @item assign:权限分配
 */


/**
 * RoleController implements the CRUD actions for AuthItem model.
 */
class RoleController extends AceController
{
    /**
     * Lists all AuthItem models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AuthItemSearch();
        $searchModel->type = 1;

        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AuthItem model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new AuthItem model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new AuthItem();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $auth = Yii::$app->authManager;
            $role = $auth->createRole(null);
            $role->name = $model->name;
            $role->description = $model->description;
            $role->ruleName = $model->rule_name;
            $role->data = $model->data;
            if ($auth->add($role)) {
                return $this->redirect(['index']);
            }
        }

        return $this->render('create', [
            'model' => $model
        ]);

    }

    /**
     * Updates an existing AuthItem model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $auth = Yii::$app->authManager;
            $role = $auth->createRole(null);
            $role->name = $model->name;
            $role->description = $model->description;
            $role->ruleName = $model->rule_name;
            $role->data = $model->data;
            if ($auth->update($model->name, $role)) {
                return $this->redirect(['index']);
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);

    }

    /**
     * Deletes an existing AuthItem model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }


    /**
     * @param $name
     * @return string|\yii\web\Response
     * 权限分配
     */
    public function actionAssign($name)
    {
        $model = new Role();

        if (Yii::$app->request->isPost) {

            $model->roles = Yii::$app->request->post('roles', []);
            $model->permissions = Yii::$app->request->post('permissions', []);
            if ($model->setChildren($name)) {
                return $this->redirect(['index']);
            }
        }

        return $this->render('assign', [
            'model' => $model,
            'roles' => $model->getRoles($name),
            'permissions' => $model->getPermissions($name),
        ]);
    }


    /**
     * Finds the AuthItem model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return AuthItem the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AuthItem::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
