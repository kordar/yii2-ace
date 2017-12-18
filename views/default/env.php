<div class="ace-default-index">

    <?php
    use yii\widgets\ActiveForm;
    ?>

    <?php $form = ActiveForm::begin([
            'action' => ['upload'],
            'options' => ['enctype' => 'multipart/form-data']
    ]) ?>

    <?= $form->field($model,'avatar')->widget('kordar\upload\widget\SingleUpload', [
          'options' => ['id' => 'avatar-upload']
    ]) ?>

    <button>Submit</button>

    <?php ActiveForm::end() ?>

</div>

<?php

$js = <<<JS

    $('#upload').on('change', function() {
        
        // 检查是否支持FormData
    　　if(window.FormData) {
        
    　　　　var formData = new FormData();
    　　　　// 建立一个upload表单项，值为上传的文件
    　　　　formData.append('SingleUploadForm[file]', document.getElementById('upload').files[0]);
    　　　　var xhr = new XMLHttpRequest();
    　　　　xhr.open('POST', $(this).parents('form').attr('action'));
    　　　　// 定义上传完成后的回调函数
    　　　　xhr.onload = function () {
    　　　　　　if (xhr.status === 200) {
                var json = $.parseJSON(xhr.responseText);
                if (json.status === 'success') {
                    alert(json.path);
                } else {
                    bootboxWarning(json.msg);
                }
    　　　　　　} else {
    　　　　　　　　console.log('出错了');
    　　　　　　}
    　　　　};
    　　　　xhr.send(formData);
    　　}
    
    });

JS;

$this->registerJs($js);

?>
