<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kordar\ace\helper\SidebarHelper;
use kordar\ace\helper\ActiveFormHelper;

/* @var $this yii\web\View */
/* @var $model kordar\ace\models\Sidebar */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sidebar-form well">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'href')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'parent_id')->dropDownList(SidebarHelper::getSidebarDropDownList(Yii::t('ace.menu', 'Please choose superior menu'))) ?>

    <?= $form->field($model, 'icon')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'active')->radioList(Yii::$app->params['activeDownList'], ActiveFormHelper::aceRadioListOptions()) ?>

    <?= $form->field($model, 'hidden')->radioList(Yii::$app->params['activeDownList'], ActiveFormHelper::aceRadioListOptions()) ?>

    <?= $form->field($model, 'sort')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('ace', 'Create') : Yii::t('ace', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
