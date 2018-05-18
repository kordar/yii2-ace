<?php

$this->title = Yii::t('ace.demo', 'Dashboard');
$this->params['breadcrumbs'][] = ['label' => $this->title, 'icon' => 'fa-tachometer']

?>

<div class="page-header">
    <h1>
        <?= Yii::t('ace.demo', 'Dashboard')?>
        <small>
            <i class="ace-icon fa fa-angle-double-right"></i>
            <?= Yii::t('ace.demo', 'overview & stats')?>
        </small>
    </h1>
</div><!-- /.page-header -->

<?= \kordar\ace\web\widgets\boxes\InfoBox::widget()?>

<?= \kordar\ace\web\widgets\boxes\InfoBox::widget(['template' => '{infoBoxIcon}{infoBoxData}{stat}'])?>

<?= \kordar\ace\web\widgets\boxes\InfoBox::widget(['template' => '{infoBoxIcon}{infoBoxData}'])?>

<?= \kordar\ace\web\widgets\boxes\InfoBox::widget(['template' => '{infoBoxChart}{infoBoxData}{badge}'])?>

<?= \kordar\ace\web\widgets\boxes\InfoBox::widget(['template' => '{infoBoxProgress}{infoBoxData2}'])?>

<div class="space-6"></div>

<?= \kordar\ace\web\widgets\boxes\InfoBox::widget([
        'theme' => 'infobox-green infobox-small infobox-dark',
        'template' => '{infoBoxProgress}{infoBoxData3}',
        'progressSize' => 39,
])?>

<?= \kordar\ace\web\widgets\boxes\InfoBox::widget([
    'theme' => 'infobox-blue infobox-small infobox-dark',
    'template' => '{infoBoxChart}{infoBoxData3}',
    'progressSize' => 39,
])?>

<?= \kordar\ace\web\widgets\boxes\InfoBox::widget([
    'theme' => 'infobox-grey infobox-small infobox-dark',
    'template' => '{infoBoxIcon}{infoBoxData3}',
    'progressSize' => 39,
])?>

<div class="space-6"></div>

<div class="row">
    <div class="col-sm-4">
        <div class="widget-box">
            <div class="widget-header widget-header-flat widget-header-small">
                <h5 class="widget-title">
                    <i class="ace-icon fa fa-pie-chart"></i>
                    Flot Pie Chart
                </h5>
            </div>

            <div class="widget-body">
                <div class="widget-main">
                    <?= \kordar\ace\web\widgets\charts\PieChart::widget([
                            'data' => [
                                ["label"=>"Item A",  "data"=>12.0, "color"=>"#68BC31"],
                                ["label"=>"Item B",  "data"=>12.0, "color"=>"#67DEFD"],
                                ["label"=>"Item C",  "data"=>40.0, "color"=>"#21BC31"],
                            ]
                    ])?>
                </div><!-- /.widget-main -->
            </div><!-- /.widget-body -->
        </div><!-- /.widget-box -->
    </div>
</div>

<div class="space-6"></div>

<div class="row">
    <div class="col-sm-7">
        <div class="widget-box transparent">
            <div class="widget-header widget-header-flat">
                <h4 class="widget-title lighter">
                    <i class="ace-icon fa fa-signal"></i>
                    Sale Stats
                </h4>
            </div>

            <div class="widget-body">
                <div class="widget-main padding-4">
                    <?= \kordar\ace\web\widgets\charts\SalesChart::widget()?>
                </div><!-- /.widget-main -->
            </div><!-- /.widget-body -->
        </div><!-- /.widget-box -->
    </div><!-- /.col -->
</div><!-- /.row -->