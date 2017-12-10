<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model kordar\ace\modules\rbac\models\AuthItem */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="auth-item-form well">

    <?php $form = ActiveForm::begin(); ?>

    <?php if($model->isNewRecord):?>
        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    <?php else:?>
        <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'readonly'=>true]) ?>
    <?php endif;?>

    <?= $form->field($model, 'description')->textInput() ?>

    <?= $form->field($model, 'rule_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'data')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('ace', 'Create') : Yii::t('ace', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
