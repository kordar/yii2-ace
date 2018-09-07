<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kordar\ace\web\helper\DetailViewHelper;

/* @var $this yii\web\View */
/* @var $model kordar\ace\models\menu\Menu */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => \Yii::t('ace.menu', 'Menus'), 'url' => ['index'], 'icon'=>'fa-list'];
$this->params['breadcrumbs'][] = ['label' => $this->title, 'icon'=>'fa-eye'];

$this->params['link'] = 'ace/menu/index';

?>
<div class="sidebar-view">

    <?= \kordar\ace\web\widgets\page\PageHeader::widget([
        'title' => Html::encode($this->title),
        'small' => Yii::t('ace', 'Grid View')
    ])?>

    <p>
        <?= Html::a(\Yii::t('yii', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(\Yii::t('yii', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => \Yii::t('yii', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'href',
            'parent_title',
            'language',
            DetailViewHelper::fontAwesomeIcon($model->icon, 'icon'),
            DetailViewHelper::active($model->active, 'active'),
            'sort',
            DetailViewHelper::status($model->status, 'status'),
            'created_at:datetime',
            'updated_at:datetime',
        ],

    ]) ?>

</div>