<?php

namespace kordar\ace\controllers;

use kordar\ace\models\rbac\AuthItem;
use kordar\ace\models\rbac\AuthItemSearch;
use kordar\ace\models\rbac\Role;
use Yii;
use yii\web\NotFoundHttpException;

/**
 * MenuController implements the CRUD actions for MenuView model.
 * @item *:Rbac权限管理
 */

class RbacController extends AceController
{
    protected $verbs = [
        'delete-permission' => ['POST'],
        'delete-role' => ['POST'],
    ];

    /**
     * @return string
     * @item permissions:权限节点列表
     */
    public function actionPermissions()
    {
        return $this->authItems(2, 'permission/index');
    }

    /**
     * @return string|\yii\web\Response
     * @item create-permission:创建权限节点
     */
    public function actionCreatePermission()
    {
        $model = new AuthItem();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $auth = Yii::$app->authManager;
            $permission = $auth->createPermission(null);
            $permission->name = $model->name;
            $permission->description = $model->description;
            $permission->ruleName = $model->rule_name;
            $permission->data = $model->data;
            if ($auth->add($permission)) {
                return $this->redirect(['permissions']);
            }
        }
        return $this->render('item/permission/create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing AuthItem model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @item update-permission:更新权限节点
     */
    public function actionUpdatePermission($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $auth = Yii::$app->authManager;
            $permission = $auth->createPermission(null);
            $permission->name = $model->name;
            $permission->description = $model->description;
            $permission->ruleName = $model->rule_name;
            $permission->data = $model->data;
            if ($auth->update($model->name, $permission)) {
                return $this->redirect(['permissions']);
            }
        }

        return $this->render('item/permission/update', [
            'model' => $model,
        ]);
    }

    /**
     * @param $id
     * @return mixed
     * @item view-permission:查看权限节点
     */
    public function actionViewPermission($id)
    {
        return $this->authItemView($id, 'permission/view');
    }

    /**
     * @param $id
     * @return \yii\web\Response
     * @item delete-permission:删除权限节点
     */
    public function actionDeletePermission($id)
    {
        $auth = Yii::$app->authManager;
        $obj = $auth->getPermission($id);
        $auth->remove($obj);
        return $this->redirect(['permissions']);
    }

    /**
     * @return string
     * @item roles:角色列表
     */
    public function actionRoles()
    {
        return $this->authItems(1, 'role/index');
    }

    /**
     * @return string|\yii\web\Response
     * @throws \Exception
     * @item create-role:创建角色
     */
    public function actionCreateRole()
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
                return $this->redirect(['roles']);
            }
        }
        return $this->render('item/role/create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing AuthItem model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @item update-role:更新角色
     */
    public function actionUpdateRole($id)
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
                return $this->redirect(['roles']);
            }
        }

        return $this->render('item/role/update', [
            'model' => $model,
        ]);
    }

    /**
     * @param $id
     * @return mixed
     * @item view-role:查看角色
     */
    public function actionViewRole($id)
    {
        return $this->authItemView($id, 'role/view');
    }

    /**
     * @param $id
     * @return \yii\web\Response
     * @item delete-role:删除角色
     */
    public function actionDeleteRole($id)
    {
        $auth = Yii::$app->authManager;
        $obj = $auth->getRole($id);
        $auth->remove($obj);
        return $this->redirect(['roles']);
    }

    /**
     * Displays a single AuthItem model.
     * @param string $id
     * @return mixed
     */
    public function authItemView($id, $view)
    {
        return $this->render('item/' . $view, [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * @param $type
     * @param $view
     * @return string
     */
    protected function authItems($type, $view)
    {
        $searchModel = new AuthItemSearch();
        $searchModel->type = $type;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('item/' . $view, [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * @param $id
     * @return string|\yii\web\Response
     * @item assign:权限分配
     */
    public function actionAssign($id)
    {
        $model = new Role();
        $model->name = $id;

        if (Yii::$app->request->isPost) {

            $model->roles = Yii::$app->request->post('roles', []);
            $model->permissions = Yii::$app->request->post('permissions', []);
            if ($model->setChildren($id)) {
                Yii::$app->session->setFlash('success', '<b>' . $id . '</b> ' . Yii::t('ace.rbac', 'Permission assignment is successful'));
                return $this->redirect(['roles']);
            }
            Yii::$app->session->setFlash('warning', Yii::t('ace.rbac', 'Permission assignment failed'));
        }

        return $this->render('item/assign', [
            'model' => $model,
            'roles' => $model->getRoles($id),
            'permissions' => $model->getPermissions($id),
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
