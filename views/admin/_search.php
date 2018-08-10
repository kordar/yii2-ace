<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kordar\ace\models\admin\Admin;

/* @var $this yii\web\View */
/* @var $model kordar\ace\models\menu\MenuSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="admin-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'class' => 'form-inline'
        ],
        'fieldConfig' => [
            'template' => '<div class="form-control">{label}</div>{input}'
        ]
    ]); ?>

    <?= \kordar\ace\web\widgets\search\DropDownSearch::widget(['model' => $model, 'items' => ['id', 'name', 'username', 'email']])?>

    <?= \kordar\ace\web\widgets\search\DropDownDateSearch::widget(['model' => $model, 'items' => ['created_at']])?>

    <?= $form->field($model, 'status', ['template'=>"{input}"])->dropDownList(Admin::statusList(), ['prompt'=>'管理员状态']) ?>

    <?= $form->field($model, 'type', ['template'=>"{input}"])->dropDownList(Admin::typeList(), ['prompt'=>'管理员类型']) ?>

    <div class="form-group">
        <?= Html::submitButton('<i class="ace-icon fa fa-search bigger-110"></i> ' . Yii::t('ace', 'Search'), ['class' => 'btn btn-primary btn-sm']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
