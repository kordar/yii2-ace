<<<<<<< HEAD
<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model kordar\ace\modules\rbac\models\AuthItem */

$this->title = $model->description;
$this->params['breadcrumbs'][] = ['label' => Yii::t('ace.rbac', 'Roles'), 'url' => ['roles'], 'icon'=>'fa-list'];
$this->params['breadcrumbs'][] = ['label' => $this->title];

$this->params['link'] = 'ace/rbac/roles';
?>
<div class="auth-item-view">

    <?= \kordar\ace\web\widgets\page\PageHeader::widget([
        'title' => Html::encode($this->title),
        'small' => Yii::t('ace', 'Grid Update')
    ])?>

    <p>
        <?= Html::a(Yii::t('yii', 'Update'), ['update-role', 'id' => $model->name], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('yii', 'Delete'), ['delete-role', 'id' => $model->name], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'name',
            'type',
            'description:ntext',
            'rule_name',
            'data',
            'created_at:datetime',
            'updated_at:datetime',
        ],
    ]) ?>

=======
<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model kordar\ace\modules\rbac\models\AuthItem */

$this->title = $model->description;
$this->params['breadcrumbs'][] = ['label' => Yii::t('ace.rbac', 'Roles'), 'url' => ['roles'], 'icon'=>'fa-list'];
$this->params['breadcrumbs'][] = ['label' => $this->title];

$this->params['link'] = 'ace/rbac/roles';
?>
<div class="auth-item-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('yii', 'Update'), ['update-role', 'id' => $model->name], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('yii', 'Delete'), ['delete-role', 'id' => $model->name], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'name',
            'type',
            'description:ntext',
            'rule_name',
            'data',
            'created_at:datetime',
            'updated_at:datetime',
        ],
    ]) ?>

>>>>>>> d0c4193369e4b589b30d4aed5efda89d4a6500d4
</div>