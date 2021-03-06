<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kordar\ace\web\helper\ActiveFormHelper;
use kordar\ace\web\helper\RbacHelper;


/* @var $this yii\web\View */
/* @var $model kordar\ace\models\rbac\AuthItem */

/**
 * @var $roles
 * @var $permissions
 * @var $userId
 */

$this->title = Yii::t('ace.admin', 'Admin Assign');
$this->params['breadcrumbs'][] = ['label' => Yii::t('ace.admin', 'Admins'), 'url' => ['index'], 'icon' => 'fa-list'];
$this->params['breadcrumbs'][] = $this->title;

$this->params['link'] = 'ace/admin/index';
?>

<div class="role-create">

    <?= \kordar\ace\web\widgets\page\PageHeader::widget([
        'title' => Html::encode($this->title),
        'small' => Html::tag('b', '[' . $name . '] ') . Yii::t('ace', 'Assign')
    ])?>

    <div class="role-form">

        <div class="well well-checkbox">
            <h4 class="green smaller lighter">管理员名称：<?= $name?></h4>
        </div>

        <?php $form = ActiveForm::begin(); ?>

        <div class="well well-checkbox">
            <h4 class="green smaller lighter"><?= Yii::t('ace.rbac', 'Assign Roles')?></h4>

            <?= Html::checkboxList('roles', RbacHelper::rolesByUser($userId), RbacHelper::roles(), ActiveFormHelper::aceCheckboxListOptions());?>

        </div>

        <div class="well well-checkbox">
            <h4 class="orange smaller lighter"><?= Yii::t('ace.rbac', 'Assign Permissions')?></h4>

            <?php foreach (RbacHelper::permissionsToGroup() as $permission):?>
                <?= Html::checkboxList('permissions', RbacHelper::permissionsByUser($userId), $permission, ActiveFormHelper::aceCheckboxListOptions());?>
                <hr>
            <?php endforeach;?>

        </div>

        <div class="form-group">
            <?= Html::submitButton(Yii::t('ace', 'Submit'), ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>