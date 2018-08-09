<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kordar\ace\web\helper\GridViewHelper;

/* @var $this yii\web\View */
/* @var $searchModel kordar\ace\modules\rbac\models\AuthItemSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('ace.rbac', 'Roles');
$this->params['breadcrumbs'][] = ['label' => $this->title, 'icon' => 'fa-list'];
?>
<div class="auth-item-index">

    <?= \kordar\ace\web\widgets\page\PageHeader::widget([
        'title' => Html::encode($this->title),
        'small' => Yii::t('ace', 'Create') . ' &amp; ' .  Yii::t('ace', 'Edit') . ' &amp; ' . Yii::t('ace', 'Assign')
    ])?>

    <p>
        <?= Html::a(Yii::t('ace.rbac', Html::tag('span', '', ['class'=>'fa fa-group']) . ' {title}', ['title'=>Yii::t('ace.rbac', 'Create Role')]), ['create-role'], ['class' => 'btn btn-success btn-sm']) ?>
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
                'template' => ['view', 'update', 'assign', 'delete'],
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