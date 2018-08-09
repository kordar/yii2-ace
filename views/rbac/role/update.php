<<<<<<< HEAD
<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model kordar\ace\modules\rbac\models\AuthItem */

$this->title =  Yii::t('ace.rbac', 'Update Role') . '：' . $model->description;
$this->params['breadcrumbs'][] = ['label' => Yii::t('ace.rbac', 'Roles'), 'url' => ['roles'], 'icon'=>'fa-list'];
$this->params['breadcrumbs'][] = ['label' => $model->description, 'url' => ['view-role', 'id' => $model->name], 'icon'=>'fa-eye'];
$this->params['breadcrumbs'][] = ['label'=> Yii::t('ace', 'Update'), 'icon'=>'fa-edit'];

$this->params['link'] = 'ace/rbac/roles';
?>

<div class="auth-item-update">

    <?= \kordar\ace\web\widgets\page\PageHeader::widget([
        'title' => Html::encode($this->title),
        'small' => Yii::t('ace', 'Grid Update')
    ])?>

    <?= $this->render('../_form', [
        'model' => $model,
    ]) ?>

</div>
=======
<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model kordar\ace\modules\rbac\models\AuthItem */

$this->title =  Yii::t('ace.rbac', 'Update Role') . '：' . $model->description;
$this->params['breadcrumbs'][] = ['label' => Yii::t('ace.rbac', 'Roles'), 'url' => ['roles'], 'icon'=>'fa-list'];
$this->params['breadcrumbs'][] = ['label' => $model->description, 'url' => ['view-role', 'id' => $model->name], 'icon'=>'fa-eye'];
$this->params['breadcrumbs'][] = ['label'=> Yii::t('ace', 'Update'), 'icon'=>'fa-edit'];

$this->params['link'] = 'ace/rbac/roles';
?>

<div class="auth-item-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('../_form', [
        'model' => $model,
    ]) ?>

</div>
>>>>>>> d0c4193369e4b589b30d4aed5efda89d4a6500d4
