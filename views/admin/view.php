<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model kordar\ace\models\admin\Admin */

$this->title = $model->username;
$this->params['breadcrumbs'][] = ['label' => Yii::t('ace.admin', 'Admins'), 'url' => ['index'], 'icon'=>'fa-list'];
$this->params['breadcrumbs'][] = $this->title;

$this->params['link'] = 'ace/admin/index';
?>
<div class="admin-view">

    <?= \kordar\ace\web\widgets\page\PageHeader::widget([
        'title' => Html::encode($this->title),
        'small' => Yii::t('ace', 'Grid View')
    ])?>

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
            'name',
            'avatar',
            'username',
            'auth_key',
            'password_hash',
            'password_reset_token',
            'email:email',
            'status_name',
            'type_name',
            'created_at:datetime',
            'updated_at:datetime',
        ],
    ]) ?>

</div>