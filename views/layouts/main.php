<?php
/* @var $this \yii\web\View */
/* @var $content string */

use kordar\ace\AppAsset;
use yii\helpers\Html;
use kordar\ace\helper\SidebarHelper;

$assetObj = AppAsset::register($this);

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>

<body class="no-skin">
<?php $this->beginBody() ?>

    <?= \kordar\ace\widgets\Navbar::widget(['baseUrl'=>$assetObj->baseUrl]);?>

    <div class="main-container ace-save-state" id="main-container">

        <script type="text/javascript">
            try{ace.settings.loadState('main-container')}catch(e){}
        </script>

        <?= \kordar\ace\widgets\Sidebar::widget([
            'link'=> empty($this->params['link']) ? SidebarHelper::linker() : $this->params['link'],
            'tree'=> SidebarHelper::getTree()
        ]);?>

        <div class="main-content">

            <div class="main-content-inner">
                <div class="breadcrumbs ace-save-state" id="breadcrumbs">

                    <?= \kordar\ace\widgets\Breadcrumbs::widget([
                       'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                    ]) ?>

                    <?php if (isset($this->blocks['breadcrumbsAfter'])): ?>
                        <?= $this->blocks['breadcrumbsAfter'] ?>
                    <?php endif; ?>

                </div>

                <div class="page-content">

                    <?php // \kordar\ace\widgets\Setting::widget(); ?>

                    <!--
                    <div class="page-header">
                        <h1>
                            Dashboard
                            <small>
                                <i class="ace-icon fa fa-angle-double-right"></i>
                                overview &amp; stats
                            </small>
                        </h1>
                    </div>
                    -->
                    <!-- /.page-header -->

                    <div class="row">
                        <div class="col-xs-12">
                            <!-- PAGE CONTENT BEGINS -->
                            <?php // \kordar\ace\widgets\Alert::widget() ?><!-- /.breadcrumb -->

                            <?= $content; ?>

                            <!-- PAGE CONTENT ENDS -->
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.page-content -->
            </div>


        </div><!-- /.main-content -->

        <div class="footer">
            <div class="footer-inner">
                <div class="footer-content">
                            <span class="bigger-120">
                                <span class="blue bolder">Ace</span>
                                Application &copy; 2013-2014
                            </span>

                    &nbsp; &nbsp;
                    <span class="action-buttons">
                                <a href="#">
                                    <i class="ace-icon fa fa-twitter-square light-blue bigger-150"></i>
                                </a>

                                <a href="#">
                                    <i class="ace-icon fa fa-facebook-square text-primary bigger-150"></i>
                                </a>

                                <a href="#">
                                    <i class="ace-icon fa fa-rss-square orange bigger-150"></i>
                                </a>
                            </span>
                </div>
            </div>
        </div>

    </div>

<!-- inline scripts related to this page -->

<?php

$path = $assetObj->baseUrl . '/js/ZeroClipboard.swf';

$js = <<<JS
    $('.copy-zclip').each(function() {
          $(this).zclip({path: '{$path}', copy: function(){var txt = $(this).attr('data-copy');return txt; }});
    });
JS;

$this->registerJs($js);

?>

<?php $this->endBody() ?>

</body>
</html>
<?php $this->endPage() ?>
