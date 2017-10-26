<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

$this->title = '密码重置';

/**
 * @var $model
 */

?>
<div id="signup-box" class="signup-box visible widget-box no-border">
    <div class="widget-body">
        <div class="widget-main">
            <h4 class="header green lighter bigger">
                <i class="ace-icon fa fa-users blue"></i>
                密码重置
            </h4>

            <div class="space-6"></div>
            <p>填写信息: </p>

            <?php $form = ActiveForm::begin([
                'method'=>'post',
            ]) ?>

            <fieldset>

                <?= $form->field($model, 'password', [
                    'template' => "<span class='block input-icon input-icon-right'>{input}<i class=\"ace-icon fa fa-lock\"></i></span>{error}"
                ])->passwordInput(['placeholder'=>'密码']) ?>

                <?= $form->field($model, 'repassword', [
                    'template' => "<span class='block input-icon input-icon-right'>{input}<i class=\"ace-icon fa fa-lock\"></i></span>{error}"
                ])->passwordInput(['placeholder'=>'确认密码']) ?>

                <div class="space-6"></div>

                <div class="clearfix">

                    <?= Html::submitButton(
                        Html::tag('span', '提交', ['class'=>'bigger-110']) . "\n" .
                        Html::tag('i', '', ['class'=>'ace-icon fa fa-arrow-right icon-on-right']),
                        ['class' => 'width-35 pull-right btn btn-sm btn-success','name' => 'login-button'])
                    ?>

                </div>
            </fieldset>

            <?php ActiveForm::end(); ?>

        </div>

        <div class="toolbar center">

            <?= Html::a(
                "<i class=\"ace-icon fa fa-arrow-left\"></i>\n返回登录",
                ['site/login'],
                ['class'=>'back-to-login-link']
            ) ?>

        </div>
    </div><!-- /.widget-body -->
</div><!-- /.signup-box -->
