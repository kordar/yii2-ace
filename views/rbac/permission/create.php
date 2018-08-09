<<<<<<< HEAD
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

    <?= \kordar\ace\web\widgets\page\PageHeader::widget([
        'title' => Html::encode($this->title),
        'small' => Yii::t('ace', 'Create')
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
>>>>>>> d0c4193369e4b589b30d4aed5efda89d4a6500d4
