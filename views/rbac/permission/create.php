<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model kordar\ace\modules\rbac\models\AuthItem */

$this->title = Yii::t('ace.rbac', 'Create Permission');
$this->params['breadcrumbs'][] = ['label' => Yii::t('ace.rbac', 'Permissions'), 'url' => ['permissions'], 'icon' => 'fa-list'];
$this->params['breadcrumbs'][] = $this->title;

$this->params['link'] = 'ace/rbac/permissions';
?>
<div class="auth-item-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('../_form', [
        'model' => $model,
    ]) ?>

</div>
