<?php
/**
 * @var $iconsList
 */
?>

<div class="space-4"></div>

<div class="col-xs-12">
    <div class="input-group">

    <span class="input-group-addon" id="zclip-addon">
        <i class="ace-icon fa fa-check"></i>
    </span>

        <input type="text" class="form-control search-query input-lg" id="zclip-input" placeholder="Type your query">
        <span class="input-group-btn">
        <button type="button" class="btn btn-inverse btn-white btn-lg copy-zclip" style="position: relative" id="zclip-button" data-copy="">
            <span class="ace-icon fa fa-copy icon-on-right bigger-180"></span>
            <span>复制</span>
        </button>
    </span>
    </div>
</div>


<?php foreach ($iconsList as $title => $group):?>

    <div class="col-xs-12">
        <h3 class="header smaller lighter blue">
            <a href="#"><?= $title?></a>
        </h3>
    </div>

    <?php foreach ($group as $icon):?>

        <div class="fontawesome-icon-list">
            <div class="fa-hover col-xs-4 col-sm-3">
                <a><i class="fa fa-<?= $icon?>" aria-hidden="true"></i> <span class="sr-only"> </span><?= $icon?></a>
            </div>
        </div>

    <?php endforeach;?>

<?php endforeach;?>

<?php

$js = <<<JS
    $('.fa-hover').click(function() {
      var txt = 'fa fa-' + $.trim($(this).text());
      $('#zclip-input').val(txt);
      $('#zclip-addon').children('i').attr('class', 'ace-icon ' + txt);
      $('#zclip-button').attr('data-copy', txt);
    });
JS;

$this->registerJs($js);

?>
