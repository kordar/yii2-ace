<?php
/* @var $this \yii\web\View */
/* @var $content string */

use kordar\ace\web\AceAsset;
use yii\helpers\Html;

AceAsset::register($this);

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

    <?php

    echo \kordar\ace\widgets\Navbar::widget();

    ?>

    <div class="main-container ace-save-state" id="main-container">

        <script type="text/javascript">
            try{ace.settings.loadState('main-container')}catch(e){}
        </script>

        <?php
            echo \kordar\ace\widgets\Sidebar::widget(['tree' => \kordar\ace\models\Sidebar::find()
                            ->select(['id', 'parent_id', 'title', 'href', 'icon', 'active', 'sort'])
                            ->asArray()->all()]);
        ?>

        <div class="main-content">

            <div class="main-content-inner">
                <div class="breadcrumbs ace-save-state" id="breadcrumbs">

                    <?= \kordar\ace\widgets\Breadcrumbs::widget([
                        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                    ]) ?>

                </div>

                <div class="page-content">

                    <?= \kordar\ace\widgets\Setting::widget(); ?>

                    <div class="page-header">
                        <h1>
                            Dashboard
                            <small>
                                <i class="ace-icon fa fa-angle-double-right"></i>
                                overview &amp; stats
                            </small>
                        </h1>
                    </div><!-- /.page-header -->

                    <div class="row">
                        <div class="col-xs-12">
                            <!-- PAGE CONTENT BEGINS -->
                            <?= \kordar\ace\widgets\Alert::widget() ?><!-- /.breadcrumb -->

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

<?php $this->endBody() ?>

</body>
</html>
<?php $this->endPage() ?>
