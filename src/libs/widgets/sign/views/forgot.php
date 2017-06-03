<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
?>
<div id="forgot-box" class="forgot-box visible widget-box no-border">
    <div class="widget-body">
        <div class="widget-main">
            <h4 class="header red lighter bigger">
                <i class="ace-icon fa fa-key"></i>
                找回密码
            </h4>

            <?= \kordar\ace\widgets\Alert::widget() ?>

            <div class="space-6"></div>
            <p>
                输入您的电子邮件和接收指令
            </p>

            <?php $form = ActiveForm::begin([
                'action'=>['site/request-password-reset'],
                'method'=>'post',
            ]) ?>

                <fieldset>

                    <?= $form->field($model, 'email', [
                        'template' => "{$prefix}fa-envelope{$suffix}"
                    ])->textInput(['type' => 'email', 'placeholder'=>'Email']) ?>

                    <div class="clearfix">

                        <?= Html::submitButton(
                            '<i class="ace-icon fa fa-lightbulb-o"></i>
                            <span class="bigger-110">发送邮件</span>',
                            ['class' => 'width-35 pull-right btn btn-sm btn-danger'])
                        ?>

                    </div>
                </fieldset>

            <?php ActiveForm::end(); ?>
        </div><!-- /.widget-main -->

        <div class="toolbar center">
            <?= Html::a(
                "返回登录\n<i class=\"ace-icon fa fa-arrow-right\"></i>",
                ['site/login'],
                ['class'=>'back-to-login-link']
            ) ?>
        </div>
    </div><!-- /.widget-body -->
</div><!-- /.forgot-box -->