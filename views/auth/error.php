<?php

/* @var $this yii\web\View */
/* @var $code string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = \Yii::t('ace.login', 'Error Page');
?>

    <div class="main-content-inner">

        <div class="page-content">

            <div class="row">
                <div class="col-xs-12">
                    <!-- PAGE CONTENT BEGINS -->

                    <div class="error-container">
                        <div class="well">
                            <h1 class="grey lighter smaller">
                                <span class="blue bigger-125">
                                    <i class="ace-icon fa fa-random"></i>
                                    <?= '#' . $code;?>
                                </span>

                            </h1>

                            <hr>
                            <h3 class="lighter smaller">
                                <i class="ace-icon fa fa-wrench icon-animated-wrench bigger-125"></i>
                                <?= Html::encode($message)?>
                            </h3>

                            <div class="space"></div>

                        </div>
                    </div>

                    <!-- PAGE CONTENT ENDS -->
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.page-content -->
    </div>

