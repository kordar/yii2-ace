<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

$this->title = \Yii::t('ace.login', 'Reset Password');

/**
 * @var $model
 */

?>
<div id="signup-box" class="signup-box visible widget-box no-border">
    <div class="widget-body">
        <div class="widget-main">
            <h4 class="header green lighter bigger">
                <i class="ace-icon fa fa-users blue"></i>
                <?= $this->title; ?>
            </h4>

            <div class="space-6"></div>
            <p><?= \Yii::t('ace.login', 'Enter your details to begin:')?> </p>

            <?php $form = ActiveForm::begin([
                'method'=>'post',
            ]) ?>

            <fieldset>

                <?= $form->field($model, 'password', [
                    'template' => "<span class='block input-icon input-icon-right'>{input}<i class=\"ace-icon fa fa-lock\"></i></span>{error}"
                ])->passwordInput(['placeholder' => \Yii::t('ace.login', 'Password')]) ?>

                <?= $form->field($model, 'repassword', [
                    'template' => "<span class='block input-icon input-icon-right'>{input}<i class=\"ace-icon fa fa-lock\"></i></span>{error}"
                ])->passwordInput(['placeholder' => \Yii::t('ace.login', 'confirmPassword')]) ?>

                <div class="space-6"></div>

                <div class="clearfix">

                    <?= Html::submitButton(
                        Html::tag('span', \Yii::t('ace', 'Submit'), ['class'=>'bigger-110']) . "\n" .
                        Html::tag('i', '', ['class'=>'ace-icon fa fa-arrow-right icon-on-right']),
                        ['class' => 'width-35 pull-right btn btn-sm btn-success','name' => 'login-button'])
                    ?>

                </div>
            </fieldset>

            <?php ActiveForm::end(); ?>

        </div>

        <div class="toolbar center">

            <?= Html::a(
                Html::tag('i', \Yii::t('ace.login', 'Back to login'), ['class'=>'ace-icon fa fa-arrow-left']),
                ['auth/login'], ['class'=>'back-to-login-link']
            ) ?>

        </div>

    </div><!-- /.widget-body -->

</div><!-- /.signup-box -->
