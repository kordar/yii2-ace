<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $model kordar\ace\modules\rbac\models\AuthItem */

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

    <h1><?= Html::encode($this->title) ?> <small><?= $model->name; ?></small></h1>

    <div class="role-form">

        <?php $form = ActiveForm::begin(); ?>

        <div class="well well-checkbox">
            <h4 class="green smaller lighter"><?= Yii::t('ace.rbac', 'Assign Roles')?></h4>

            <?= Html::checkboxList('roles', $model->roles, $roles, [
                'item'=>function($index, $label, $name, $checked, $value) {
                    $checkedStr = $checked ? 'checked' : '';
                    return "<label><input name=\"{$name}\" class=\"ace ace-checkbox-2\" type=\"checkbox\" {$checkedStr} value=\"{$value}\"><span class=\"lbl\"> {$label}</span></label>";
                }
            ]);

            ?>

        </div>

        <div class="well well-checkbox">
            <h4 class="orange smaller lighter"><?= Yii::t('ace.rbac', 'Assign Permissions')?></h4>

            <?php foreach ($permissions as $permission):?>

                <?= Html::checkboxList('permissions', $model->permissions, $permission, [
                    'item'=>function($index, $label, $name, $checked, $value) {
                        $checkedStr = $checked ? 'checked' : '';
                        return "<label><input name=\"{$name}\" class=\"ace ace-checkbox-2\" type=\"checkbox\" {$checkedStr} value=\"{$value}\"><span class=\"lbl\"> {$label}</span></label>";
                    }
                ]);
                ?>

                <hr>

            <?php endforeach;?>

        </div>


        <div class="form-group">
            <?= Html::submitButton('提交', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>