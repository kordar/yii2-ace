<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model kordar\ace\modules\rbac\models\AuthItem */

$this->title = $model->description;
$this->params['breadcrumbs'][] = ['label' => Yii::t('ace.rbac', 'Permissions'), 'url' => ['permissions'], 'icon'=>'fa-list'];
$this->params['breadcrumbs'][] = ['label' => $this->title];

$this->params['link'] = 'ace/rbac/permissions';
?>
<div class="auth-item-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('yii', 'Update'), ['update-permission', 'id' => $model->name], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('yii', 'Delete'), ['delete-permission', 'id' => $model->name], [
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
            'name',
            'type',
            'description:ntext',
            'rule_name',
            'data',
            'created_at:datetime',
            'updated_at:datetime',
        ],
    ]) ?>

</div>