<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kordar\ace\web\helper\GridViewHelper;
use kordar\ace\web\helper\SidebarHelper;

/* @var $this yii\web\View */
/* @var $searchModel kordar\ace\models\menu\MenuSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = \Yii::t('ace.menu', 'Menus');
$this->params['breadcrumbs'][] = ['label'=>$this->title, 'icon'=>'fa-list'];
?>
<div class="sidebar-index">

    <?= \kordar\ace\web\widgets\page\PageHeader::widget([
            'title' => Html::encode($this->title),
            'small' => Yii::t('ace', 'Create') . ' &amp; ' .  Yii::t('ace', 'Edit')
    ])?>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Html::tag('i', '', ['class'=>'fa fa-plus']) . ' ' . \Yii::t('ace.menu', 'Create Menu'), ['create'], ['class' => 'btn btn-success btn-sm']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            // ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            'href',
            [
                'attribute' => 'parent_id',
                'format' => 'raw',
                'value' => function ($model) {
                    return Html::tag('i', $model->parent_title, ['class'=>'text-info']);
                },
                'filter' => SidebarHelper::getSidebarDropDownList('无')
            ],
            [
                'attribute' => 'hidden',
                'format' => 'raw',
                'value' => function ($model) {
                    return Html::tag('i', $model->hidden_name, ['class'=>'text-warning']);
                },
                'filter' => GridViewHelper::dropDownListYesOrNo(),
            ],
            // 'hidden',
            // 'language',
            // 'icon',
            // 'active',
            // 'sort',
            // 'status',
            // 'created_at',
            // 'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>