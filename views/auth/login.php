<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

$this->title = '用户登录';

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
                请输入您的信息
            </h4>

            <?= \kordar\ace\widgets\Alert::widget() ?>

            <?php $form = ActiveForm::begin(['action'=>['login'], 'method'=>'post']) ?>

            <fieldset>

                <?= $form->field($model, 'username', [
                    'template' => "<span class='block input-icon input-icon-right'>{input}<i class=\"ace-icon fa fa-user\"></i></span>{error}"
                ])->textInput(['placeholder'=>'用户名']) ?>

                <?= $form->field($model, 'password', [
                    'template' => "<span class='block input-icon input-icon-right'>{input}<i class=\"ace-icon fa fa-lock\"></i></span>{error}"
                ])->passwordInput(['placeholder'=>'密码']) ?>

                <div class="clearfix">

                    <label class="inline">
                        <?= Html::hiddenInput('LoginForm[rememberMe]', 0)?>
                        <?= Html::checkbox('LoginForm[rememberMe]', false, ['class'=>'ace'])?>
                        <span class="lbl"> 记住</span>
                    </label>

                    <?= Html::submitButton(
                        Html::tag('i', '', ['class'=>'ace-icon fa fa-key']) .
                        Html::tag('span', '登录', ['class'=>'bigger-110']),
                        ['class' => 'width-35 pull-right btn btn-sm btn-primary'])
                    ?>

                </div>

                <div class="space-4"></div>
            </fieldset>

            <?php ActiveForm::end(); ?>

            <div class="social-or-login center">
                <span class="bigger-110">第三方登录</span>
            </div>

            <div class="space-6"></div>

            <div class="social-login center">
                <a class="btn btn-primary">
                    <i class="ace-icon fa fa-facebook"></i>
                </a>

                <a class="btn btn-info">
                    <i class="ace-icon fa fa-twitter"></i>
                </a>

                <a class="btn btn-danger">
                    <i class="ace-icon fa fa-google-plus"></i>
                </a>
            </div>
        </div><!-- /.widget-main -->

        <div class="toolbar clearfix">
            <div>
                <?= Html::a(
                    "<i class=\"ace-icon fa fa-arrow-left\"></i>\n忘记密码",
                    ['auth/request-password-reset'],
                    ['class'=>'forgot-password-link']
                ) ?>
            </div>

            <div>
                <?= Html::a(
                    "注册\n<i class=\"ace-icon fa fa-arrow-right\"></i>",
                    ['auth/signup'],
                    ['class'=>'user-signup-link']
                ) ?>
            </div>
        </div>
    </div><!-- /.widget-body -->
</div><!-- /.login-box -->