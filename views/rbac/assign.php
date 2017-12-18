<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kordar\ace\helper\ActiveFormHelper;
use kordar\ace\helper\RbacHelper;

/* @var $this yii\web\View */
/* @var $model kordar\ace\models\rbac\AuthItem */

/**
 * @var $roles
 * @var $permissions
 */

$this->title = Yii::t('ace.rbac', 'Assign');
$this->params['breadcrumbs'][] = ['label' => Yii::t('ace.rbac', 'Roles'), 'url' => ['roles'], 'icon'=>'fa-group'];
$this->params['breadcrumbs'][] = $this->title;

$this->params['link'] = 'ace/rbac/roles';
?>
<div class="role-create">

    <h1><?= Html::encode($this->title) ?> <small><?= $name; ?></small></h1>

    <div class="role-form">

        <?php $form = ActiveForm::begin(); ?>

        <div class="well well-checkbox">
            <h4 class="green smaller lighter"><?= Yii::t('ace.rbac', 'Assign Roles')?></h4>

            <?= Html::checkboxList('roles', RbacHelper::rolesChild($name), RbacHelper::roles($name), ActiveFormHelper::aceCheckboxListOptions());?>

        </div>

        <div class="well well-checkbox">
            <h4 class="orange smaller lighter"><?= Yii::t('ace.rbac', 'Assign Permissions')?></h4>

            <?php foreach (RbacHelper::permissionsToGroup() as $permission):?>
                <?= Html::checkboxList('permissions', RbacHelper::permissionsByRole($name), $permission, ActiveFormHelper::aceCheckboxListOptions());?>
                <hr>
            <?php endforeach;?>

        </div>


        <div class="form-group">
            <?= Html::submitButton(Yii::t('ace', 'Submit'), ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>