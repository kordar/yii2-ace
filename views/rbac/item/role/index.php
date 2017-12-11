<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kordar\ace\helper\GridViewHelper;

/* @var $this yii\web\View */
/* @var $searchModel kordar\ace\modules\rbac\models\AuthItemSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('ace.rbac', 'Roles');
$this->params['breadcrumbs'][] = ['label' => $this->title, 'icon' => 'fa-list'];
?>
<div class="auth-item-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('ace.rbac', Html::tag('span', '', ['class'=>'fa fa-group']) . ' {title}', ['title'=>Yii::t('ace.rbac', 'Create Role')]), ['create-role'], ['class' => 'btn btn-success']) ?>
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

            GridViewHelper::actionColumn([
                'title' => '操作',
                'template' => ['view', 'update', 'delete', 'assign'],
                'item' => [
                    'view' => ['url' => 'view-role'],
                    'update' => ['url' => 'update-role'],
                    'delete' => ['url' => 'delete-role'],
                    'assign' => ['url' => 'assign']
                ]
            ]),
        ],
    ]); ?>
</div>