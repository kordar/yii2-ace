<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model kordar\ace\models\Sidebar */

$this->title = Yii::t('app', 'Create Sidebar');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Sidebars'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sidebar-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
