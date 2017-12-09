<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model kordar\ace\modules\rbac\models\AuthItem */

$this->title = '创建角色';
$this->params['breadcrumbs'][] = ['label' => '角色列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="auth-item-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>