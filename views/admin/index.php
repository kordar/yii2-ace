<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kordar\ace\helper\GridViewHelper;

/* @var $this yii\web\View */
/* @var $searchModel kordar\ace\models\admin\AdminSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('ace.admin', 'Admins');
$this->params['breadcrumbs'][] = ['label' => $this->title, 'icon' => 'fa-users']
?>
<div class="admin-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('ace.admin', 'Create Admin'), ['create'], ['class' => 'btn btn-success']) ?>
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
            'email:email',
            'status',
            'type',
            // 'created_at',
            // 'updated_at',
            GridViewHelper::actionColumn([
                'title' => '操作',
                'template' => ['view', 'update', 'delete', 'assign'],
                'item' => [
                    'view' => ['url' => 'view'],
                    'update' => ['url' => 'update'],
                    'delete' => ['url' => 'delete'],
                    'assign' => ['url' => 'assign']
                ]
            ]),

        ],
    ]); ?>
</div>
