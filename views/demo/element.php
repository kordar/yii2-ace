<?php

$this->title = Yii::t('ace.demo', 'UI Elements');
$this->params['breadcrumbs'][] = ['label' => $this->title, 'icon' => 'fa-tachometer']

?>

<div class="page-header">
    <h1>
        <?= Yii::t('ace.demo', 'UI Elements')?>
        <small>
            <i class="ace-icon fa fa-angle-double-right"></i>
            <?= Yii::t('ace.demo', 'Common UI Features & Elements')?>
        </small>
    </h1>
</div><!-- /.page-header -->

<div class="row">
    <div class="col-sm-6">
        <?= \kordar\ace\web\widgets\boxes\Tab::widget(['data' => [
            ['title'=>'title1', 'id'=>'id1', 'content'=>'content1'],
            ['title'=>'title2', 'id'=>'id2', 'content'=>'content2'],
            ['title'=>'dropdown', 'active'=>true, 'children' => [
                ['title'=>'dropdown1', 'id'=>'dropdown1',  'content'=>'dropdown content1'],
                ['title'=>'dropdown2', 'id'=>'dropdown2', 'active'=>true, 'content'=>'dropdown content2'],
            ]]
        ]])?>
    </div><!-- /.col -->

    <div class="col-sm-6">
        <?= \kordar\ace\web\widgets\boxes\Tab::widget([
            'template' => '{content}{tabs}', 'theme' => 'tabs-below',
            'data' => [
                ['title'=>'title1', 'id'=>'id11', 'content'=>'content1'],
                ['title'=>'title2', 'id'=>'id21', 'content'=>'content2'],
                ['title'=>'dropdown', 'active'=>true, 'children' => [
                    ['title'=>'dropdown1', 'id'=>'dropdown11',  'content'=>'dropdown content1'],
                    ['title'=>'dropdown2', 'id'=>'dropdown21', 'active'=>true, 'content'=>'dropdown content2'],
                ]]
            ]
        ])?>
    </div>

</div>

<div class="space"></div>

<div class="row">
    <div class="col-sm-6">
        <?= \kordar\ace\web\widgets\boxes\Tab::widget([
            'theme' => 'tabs-left',
            'data' => [
                ['title'=>'<i class="green ace-icon fa fa-home bigger-120"></i> title1', 'id'=>'id12', 'content'=>'content1'],
                ['title'=>'title2 <span class="badge badge-danger">4</span>', 'id'=>'id22', 'content'=>'content2'],
                ['title'=>'dropdown', 'active'=>true, 'children' => [
                    ['title'=>'dropdown1', 'id'=>'dropdown12', 'content'=>'dropdown content1'],
                    ['title'=>'dropdown2', 'id'=>'dropdown22', 'active'=>true, 'content'=>'dropdown content2'],
                ]]
            ]
        ])?>
    </div>

    <div class="col-sm-6">
        <?= \kordar\ace\web\widgets\boxes\Tab::widget([
            'navClass' => 'padding-12 tab-color-blue background-blue',
            'data' => [
                ['title'=>'title1', 'id'=>'id13', 'content'=>'content1'],
                ['title'=>'title2', 'id'=>'id23', 'content'=>'content2'],
                ['title'=>'dropdown', 'active'=>true, 'children' => [
                    ['title'=>'dropdown1', 'id'=>'dropdown13',  'content'=>'dropdown content1'],
                    ['title'=>'dropdown2', 'id'=>'dropdown23', 'active'=>true, 'content'=>'dropdown content2'],
                ]]
            ]
        ])?>
    </div>

</div>

