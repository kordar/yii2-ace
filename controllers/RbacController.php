<?php

namespace kordar\ace\controllers;

use kordar\ace\models\rbac\AuthItem;
use kordar\ace\models\rbac\AuthItemSearch;
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
     * @return string
     * @item roles:角色列表
     */
    public function actionRoles()
    {
        return $this->authItems(1, 'roles');
    }

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
     * @return string|\yii\web\Response
     * @item create-permission:创建权限节点
     */
    public function actionCreatePermission()
    {
        $model = new AuthItem();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $auth = Yii::$app->authManager;
            $role = $auth->createPermission(null);
            $role->name = $model->name;
            $role->description = $model->description;
            $role->ruleName = $model->rule_name;
            $role->data = $model->data;
            if ($auth->add($role)) {
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
            $role = $auth->createPermission(null);
            $role->name = $model->name;
            $role->description = $model->description;
            $role->ruleName = $model->rule_name;
            $role->data = $model->data;
            if ($auth->update($model->name, $role)) {
                return $this->redirect(['permissions']);
            }
        }

        return $this->render('item/update-permission', [
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
     * @item view-permission:删除权限节点
     */
    public function actionDeletePermission($id)
    {
        $auth = Yii::$app->authManager;
        $obj = $auth->getPermission($id);
        $auth->remove($obj);
        return $this->redirect(['permissions']);
    }

    public function actionCreateRole()
    {
        $model = new AuthItem();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $auth = Yii::$app->authManager;
            $role = $auth->createPermission(null);
            $role->name = $model->name;
            $role->description = $model->description;
            $role->ruleName = $model->rule_name;
            $role->data = $model->data;
            if ($auth->add($role)) {
                return $this->redirect(['index']);
            }
        }
        return $this->render('item/create-role', [
            'model' => $model,
        ]);
    }



    public function actionViewRole($id)
    {
        return $this->authItemView($id, 'Role/view');
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
