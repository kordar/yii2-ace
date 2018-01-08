<?php

namespace kordar\ace\controllers;

use Yii;
use kordar\ace\models\menu\Menu;
use kordar\ace\models\menu\MenuView;
use kordar\ace\models\menu\MenuSearch;
use yii\web\NotFoundHttpException;

/**
 * MenuController implements the CRUD actions for MenuView model.
 * @item *:菜单管理
 * @item create:创建菜单
 * @item delete:删除菜单
 * @item update:更新菜单
 * @item index:菜单列表
 * @item view:菜单详情
 */

class MenuController extends AceController
{
    /**
     * Lists all MenuView models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MenuSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single MenuView model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findViewModel($id),
        ]);
    }

    /**
     * Creates a new MenuView model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Menu();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing MenuView model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing MenuView model.
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
     * Finds the MenuView model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return MenuView the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Menu::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function findViewModel($id)
    {
        if (($model = MenuView::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }


    public function beforeAction($action)
    {
        $rs = parent::beforeAction($action);
        if ($rs && in_array($action->id, ['create', 'update', 'delete'])) {
            $this->on('GENERATE_SIDE_BAR', ['\kordar\ace\models\menu\Menu', 'sidebarTree']);
        }
        return $rs;
    }

    public function afterAction($action, $result)
    {
        $rs = parent::afterAction($action, $result);
        if ($rs && in_array($action->id, ['create', 'update', 'delete'])) {
            $this->trigger('GENERATE_SIDE_BAR');
        }
        return $rs;
    }


}
