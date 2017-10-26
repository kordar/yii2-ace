<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel kordar\ace\modules\rbac\models\AuthItemSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '角色列表';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="auth-item-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('创建角色', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'name',
            // 'type',
            'description:ntext',
            'rule_name',
            'data',
            // 'created_at',
            // 'updated_at',

            [
                'class' => 'yii\grid\ActionColumn',
                'header' => '操作',
                'template' => '{assign} {view} {update} {delete}',
                'buttons' => [
                    'assign' => function ($url, $model, $key) {
                        return Html::a('分配权限', ['assign', 'name' => $model['name']]);
                    },
                    'view' => function ($url, $model, $key) {
                        return Html::a('查看', ['view', 'id' => $model['name']], ['class' => 'alert-success']);
                    },
                    'update' => function ($url, $model, $key) {
                        return Html::a('更新', ['update', 'id' => $model['name']], ['class' => 'alert-warning']);
                    },
                    'delete' => function ($url, $model, $key) {
                        return Html::a('删除', ['delete', 'id' => $model['name']], [
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
