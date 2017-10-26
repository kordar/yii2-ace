<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel kordar\ace\models\search\AdminSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Admins');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="admin-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Admin'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            // ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            // 'avatar',
            'username',
            'auth_key',
            // 'password_hash',
            // 'password_reset_token',
            // 'email:email',
            // 'status',
            // 'created_at',
            // 'updated_at',

            [
                'class' => 'yii\grid\ActionColumn',
                'header' => '操作',
                'template' => '{assign} {view} {update} {delete}',
                'buttons' => [
                    'assign' => function ($url, $model, $key) {
                        return Html::a('授权', ['assign', 'id' => $model['id'], 'name'=>$model['username']]);
                    },
                    'view' => function ($url, $model, $key) {
                        return Html::a('查看', ['view', 'id' => $model['id']], ['class' => 'alert-success']);
                    },
                    'update' => function ($url, $model, $key) {
                        return Html::a('更新', ['update', 'id' => $model['id']], ['class' => 'alert-warning']);
                    },
                    'delete' => function ($url, $model, $key) {
                        return Html::a('删除', ['delete', 'id' => $model['id']], [
                            'class' => 'alert-danger',
                            'data' => [
                                'confirm' => '确定删除该角色?',
                                'method' => 'post',
                            ],
                        ]);
                    }
                ],
            ]

        ],
    ]); ?>
</div>
