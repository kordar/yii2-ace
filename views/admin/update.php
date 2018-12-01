<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model kordar\ace\models\admin\Admin */

$this->title = Yii::t('ace.admin', 'Update Admin') . '：' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('ace.admin', 'Admins'), 'url' => ['index'], 'icon' => 'fa-list'];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id], 'icon' => 'fa-eye'];
$this->params['breadcrumbs'][] = Yii::t('ace', 'Update');

$this->params['link'] = 'ace/admin/index';
?>
<div class="admin-update">

    <?= \kordar\ace\web\widgets\page\PageHeader::widget([
        'title' => Html::encode($this->title),
        'small' => Yii::t('ace', 'Grid Update')
    ])?>

    <div class="admin-form well">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'name')->textInput() ?>
        <?= $form->field($model, 'username')->textInput(['readonly' => true]) ?>
        <?= $form->field($model, 'email')->textInput() ?>
        <?= $form->field($model, 'password')->textInput() ?>

        <div class="form-group">
            <?= Html::submitButton(Yii::t('ace', 'Update'), ['class' => 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>