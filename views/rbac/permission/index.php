<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kordar\ace\web\helper\GridViewHelper;

/* @var $this yii\web\View */
/* @var $searchModel kordar\ace\modules\rbac\models\AuthItemSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('ace.rbac', 'Permissions');
$this->params['breadcrumbs'][] = ['label' => $this->title, 'icon' => 'fa-list'];
?>
<div class="auth-item-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('ace.rbac', 'Create Permission'), ['create-permission'], ['class' => 'btn btn-success']) ?>
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

            // ['class' => 'yii\grid\ActionColumn'],

            GridViewHelper::actionColumn([
                'title' => '操作',
                'template' => ['view', 'update', 'delete'],
                'item' => [
                    'view' => ['url' => 'view-permission'],
                    'update' => ['url' => 'update-permission'],
                    'delete' => ['url' => 'delete-permission'],
                ]
            ]),

        ],
    ]); ?>
</div>