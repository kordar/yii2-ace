<<<<<<< HEAD
<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model kordar\ace\models\menu\Menu */

$this->title = \Yii::t('ace.menu', 'Create Menu');
$this->params['breadcrumbs'][] = ['label' => \Yii::t('ace.menu', 'Menus'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$this->params['link'] = 'ace/menu/index';
?>
<div class="sidebar-create">

    <?= \kordar\ace\web\widgets\page\PageHeader::widget([
        'title' => Html::encode($this->title),
        'small' => Yii::t('ace', 'Create')
    ])?>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
=======
<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model kordar\ace\models\menu\Menu */

$this->title = \Yii::t('ace.menu', 'Create Menu');
$this->params['breadcrumbs'][] = ['label' => \Yii::t('ace.menu', 'Menus'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$this->params['link'] = 'ace/menu/index';
?>
<div class="sidebar-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
>>>>>>> d0c4193369e4b589b30d4aed5efda89d4a6500d4
