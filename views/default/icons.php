<?php $this->beginBlock('breadcrumbsAfter'); ?>

<div class="nav-search" id="icon-search">
    <form class="form-search">
		<span class="input-icon">
			<input type="text" placeholder="Search ..." class="nav-search-input" id="icon-search-input" autocomplete="off">
			<i class="ace-icon fa fa-search nav-search-icon"></i>
		</span>
    </form>
</div>

<?php $this->endBlock(); ?>

<?= \kordar\ace\widgets\components\IconsChosen::widget()?>

<?php
	$js = <<<JS
	$('#icon-search-input').keyup(function() {
	  var txt = $(this).val();
	  $('.fa-hover').each(function() {
	    if ($(this).text().indexOf(txt) == -1) {
	    	$(this).hide();
	    } else {
	    	$(this).show();
	    }
	  });
	});
JS;

$this->registerJs($js);

?>
