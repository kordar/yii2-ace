<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

$this->title = Yii::t('ace.login', 'User Login');

$css = <<<CSS
  body {
    background-image: url($bg);
    background-position: center center;
    background-repeat: no-repeat;
    background-size: cover;
  }
CSS;

$this->registerCss($css);

/**
 * @var $model
 */

?>

<div class="row">
    <div class="col-sm-10 col-sm-offset-1">
        <div class="login-container">


<div id="login-box" class="login-box visible widget-box no-border">
    <div class="widget-body">
        <div class="widget-main">
            <h4 class="header blue lighter bigger">
                <i class="ace-icon fa fa-coffee green"></i>
                <?= Yii::t('ace.login', 'Please Enter Your Information')?>
            </h4>

            <?= \kordar\ace\web\widgets\Alert::widget() ?>

            <?php $form = ActiveForm::begin(['action'=>['login'], 'method'=>'post']) ?>

            <fieldset>

                <?= $form->field($model, 'username', [
                    'template' => "<span class='block input-icon input-icon-right'>{input}<i class=\"ace-icon fa fa-user\"></i></span>{error}"
                ])->textInput(['placeholder'=>Yii::t('ace.login', 'Username')]) ?>

                <?= $form->field($model, 'password', [
                    'template' => "<span class='block input-icon input-icon-right'>{input}<i class=\"ace-icon fa fa-lock\"></i></span>{error}"
                ])->passwordInput(['placeholder'=>Yii::t('ace.login', 'Password')]) ?>

                <div class="clearfix">

                    <label class="inline">
                        <?= Html::hiddenInput('LoginForm[rememberMe]', 0)?>
                        <?= Html::checkbox('LoginForm[rememberMe]', false, ['class'=>'ace'])?>
                        <span class="lbl"> <?= Yii::t('ace.login', 'Remember Me')?></span>
                    </label>

                    <?= Html::submitButton(
                        Html::tag('i', '', ['class'=>'ace-icon fa fa-key']) .
                        Html::tag('span', Yii::t('ace.login', 'Login'), ['class'=>'bigger-110']),
                        ['class' => 'width-35 pull-right btn btn-sm btn-primary'])
                    ?>

                </div>

                <div class="space-4"></div>
            </fieldset>

            <?php ActiveForm::end(); ?>

        </div><!-- /.widget-main -->

    </div><!-- /.widget-body -->
</div><!-- /.login-box -->