<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model kordar\ace\models\Sidebar */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Sidebar',
]) . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Sidebars'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="sidebar-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
