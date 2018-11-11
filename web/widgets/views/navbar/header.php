<div id="navbar" class="navbar navbar-default ace-save-state">
    <div class="navbar-container ace-save-state" id="navbar-container">
        <button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler" data-target="#sidebar">
            <span class="sr-only">Toggle sidebar</span>

            <span class="icon-bar"></span>

            <span class="icon-bar"></span>

            <span class="icon-bar"></span>
        </button>

        <div class="navbar-header pull-left">

            <?= \yii\helpers\Html::a('<small><i class="fa fa-leaf"></i> ' . \Yii::$app->params["webTitle"] . '</small>', \Yii::$app->getHomeUrl(), ['class'=>'navbar-brand'])?>

        </div>

        <div class="navbar-buttons navbar-header pull-right" role="navigation">
            <ul class="nav ace-nav">

                <?php foreach ($tools as $li):?>
                    <?= $li?>
                <?php endforeach;?>

                <!--personal list-->
                <?= $personal?>

            </ul>
        </div>
    </div><!-- /.navbar-container -->
</div>