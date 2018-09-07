<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model kordar\ace\models\menu\Menu */

$this->title = Yii::t('ace.menu', 'Update Menu') . ': ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => \Yii::t('ace.menu', 'Menus'), 'url' => ['index'], 'icon'=>'fa-list'];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id], 'icon'=>'fa-eye'];
$this->params['breadcrumbs'][] = ['label' => \Yii::t('yii', 'Update'), 'icon'=>'fa-edit'];

$this->params['link'] = 'ace/menu/index';
?>
<div class="sidebar-update">

    <?= \kordar\ace\web\widgets\page\PageHeader::widget([
        'title' => Html::encode($this->title),
        'small' => Yii::t('ace', 'Grid Update')
    ])?>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>