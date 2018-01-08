<?php
use yii\bootstrap\ActiveForm;

$model = new \kordar\ace\models\admin\Admin();

?>
<div class="ace-default-index">



    <h1><?= $this->context->action->uniqueId ?></h1>

    <?php $form = ActiveForm::begin(['action'=>['index'], 'method'=>'post']) ?>

    <?= $form->field($model, 'avatar')->widget(\kordar\ace\web\widgets\upload\Well::className()) ?>

    <?= $form->field($model, 'username')->widget(\kordar\ace\web\widgets\editor\Wysiwyg::className()) ?>

    <?php ActiveForm::end(); ?>

    <p>
        This is the view content for action "<?= $this->context->action->id ?>".
        The action belongs to the controller "<?= get_class($this->context) ?>"
        in the "<?= $this->context->module->id ?>" module.
    </p>
    <p>
        You may customize this page by editing the following file:<br>
        <code><?= __FILE__ ?></code>
    </p>
</div>