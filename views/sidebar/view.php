<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kordar\ace\helper\DetailViewHelper;

/* @var $this yii\web\View */
/* @var $model kordar\ace\models\Sidebar */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('ace', 'Sidebars'), 'url' => ['index'], 'icon'=>'fa-list'];
$this->params['breadcrumbs'][] = ['label' => $this->title, 'icon'=>'fa-eye'];

$this->params['link'] = 'ace/sidebar/index';

?>
<div class="sidebar-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('yii', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('yii', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
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
            [
                'attribute' => 'parent_id',
                'value' => function ($model) {
                    return $model->parent->title;
                }
            ],
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
