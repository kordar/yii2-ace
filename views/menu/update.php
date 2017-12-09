<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model kordar\ace\models\Sidebar */

$this->title = Yii::t('ace.menu', 'Update Menu') . '：' . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('ace.menu', 'Menus'), 'url' => ['index'], 'icon'=>'fa-list'];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id], 'icon'=>'fa-eye'];
$this->params['breadcrumbs'][] = Yii::t('yii', 'Update');

$this->params['link'] = 'ace/menu/index';
?>
<div class="sidebar-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>