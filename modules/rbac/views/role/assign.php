<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $model kordar\ace\modules\rbac\models\AuthItem */

/**
 * @var $roles
 * @var $permissions
 */

$this->title = '权限分配';
$this->params['breadcrumbs'][] = ['label' => '角色管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="role-create">

    <h1><?= Html::tag('span', '', ['class'=>'alert-success']) . Html::encode($this->title) ?></h1>

    <div class="role-form">

        <div class="well well-checkbox">
            <h4 class="green smaller lighter">角色名称：<?= Yii::$app->request->get('name')?></h4>
        </div>

        <?php $form = ActiveForm::begin(); ?>

        <div class="well well-checkbox">
            <h4 class="green smaller lighter">角色列表</h4>

            <?= Html::checkboxList('roles', $model->roles, $roles, [
                'item'=>function($index, $label, $name, $checked, $value) {
                    $checkedStr = $checked ? 'checked' : '';
                    return "<label><input name=\"{$name}\" class=\"ace ace-checkbox-2\" type=\"checkbox\" {$checkedStr} value=\"{$value}\"><span class=\"lbl\"> {$label}</span></label>";
                }
            ]);

            ?>

        </div>

        <div class="well well-checkbox">
            <h4 class="orange smaller lighter">权限列表</h4>

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