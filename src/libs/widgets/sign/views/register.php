<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
?>
<div id="signup-box" class="signup-box visible widget-box no-border">
    <div class="widget-body">
        <div class="widget-main">
            <h4 class="header green lighter bigger">
                <i class="ace-icon fa fa-users blue"></i>
                用户注册
            </h4>

            <div class="space-6"></div>
            <p>填写信息: </p>

            <?php $form = ActiveForm::begin([
                'action'=>['site/signup'],
                'method'=>'post',
            ]) ?>

            <fieldset>

                <?= $form->field($model, 'email', [
                    'template' => "{$prefix}fa-envelope{$suffix}"
                ])->textInput(['placeholder'=>'邮箱', 'type'=>'email']) ?>

                <?= $form->field($model, 'username', [
                    'template' => "{$prefix}fa-user{$suffix}"
                ])->textInput(['placeholder'=>'用户名']) ?>

                <?= $form->field($model, 'password', [
                    'template' => "{$prefix}fa-lock{$suffix}"
                ])->passwordInput(['placeholder'=>'密码']) ?>

                <?= $form->field($model, 'repassword', [
                    'template' => "{$prefix}fa-retweet{$suffix}"
                ])->passwordInput(['placeholder'=>'确认密码']) ?>


<!--                <label class="block">-->
<!--                    <input type="checkbox" class="ace" />-->
<!--                    <span class="lbl">-->
<!--                        接受-->
<!--                        <a href="#">用户协议</a>-->
<!--                    </span>-->
<!--                </label>-->

                <div class="space-6"></div>

                <div class="clearfix">

                    <?= Html::resetButton(
                            Html::tag('i', '', ['class'=>'ace-icon fa fa-refresh']) . "\n" .
                            Html::tag('span', '重置', ['class'=>'bigger-110']),
                        ['class' => 'width-30 pull-left btn btn-sm', 'name' => 'login-button'])
                    ?>

                    <?= Html::submitButton(
                            Html::tag('span', '注册', ['class'=>'bigger-110']) . "\n" .
                            Html::tag('i', '', ['class'=>'ace-icon fa fa-arrow-right icon-on-right']),
                        ['class' => 'width-65 pull-right btn btn-sm btn-success','name' => 'login-button'])
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