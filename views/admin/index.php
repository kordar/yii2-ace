<<<<<<< HEAD
<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kordar\ace\web\helper\GridViewHelper;

/* @var $this yii\web\View */
/* @var $searchModel kordar\ace\models\admin\AdminSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('ace.admin', 'Admins');
$this->params['breadcrumbs'][] = ['label' => $this->title, 'icon' => 'fa-users']
?>

<div class="admin-index">

    <?= \kordar\ace\web\widgets\page\PageHeader::widget([
            'title' => $this->title,
            'small' => Yii::t('ace.admin', 'Edit') . ' &amp; ' . Yii::t('ace.admin', 'Assign')
    ]) ?>

    <p>
        <?= Html::a('<i class="ace-icon fa fa-plus-circle bigger-110"></i> ' . Yii::t('ace.admin', 'Create Admin'), ['create'], ['class' => 'btn btn-success btn-sm']) ?>
    </p>

    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php // Html::a(Yii::t('ace.admin', 'Create Admin'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        // 'filterModel' => $searchModel,
        'columns' => [
            // ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            // 'avatar',
            'username',
            'auth_key',
            // 'password_hash',
            // 'password_reset_token',
            'email:email',
            [
                'attribute' => 'status',
                'format' => 'raw',
                'value' => function ($model) {
                    return Html::tag('i', $model->status_name, ['class'=>'text-info']);
                },
                'filter' => $searchModel::statusList()
            ],
            [
                'attribute' => 'type',
                'format' => 'raw',
                'value' => function ($model) {
                    return Html::tag('i', $model->type_name, ['class'=>'text-warning']);
                },
                'filter' => $searchModel::typeList()
            ],
            // 'created_at',
            // 'updated_at',
            GridViewHelper::actionColumn([
                'title' => '操作',
                'template' => ['view', 'update', 'assign'],
                'item' => [
                    'view' => ['url' => 'view'],
                    'update' => ['url' => 'update'],
                    'assign' => ['url' => 'assign', 'attribute' => ['name']]
                ]
            ]),

        ],
    ]); ?>
</div>
=======
<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kordar\ace\web\helper\GridViewHelper;

/* @var $this yii\web\View */
/* @var $searchModel kordar\ace\models\admin\AdminSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('ace.admin', 'Admins');
$this->params['breadcrumbs'][] = ['label' => $this->title, 'icon' => 'fa-users']
?>
<div class="admin-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('ace.admin', 'Create Admin'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            // ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            // 'avatar',
            'username',
            'auth_key',
            // 'password_hash',
            // 'password_reset_token',
            'email:email',
            [
                'attribute' => 'status',
                'format' => 'raw',
                'value' => function ($model) {
                    return Html::tag('i', $model->status_name, ['class'=>'text-info']);
                },
                'filter' => $searchModel::statusList()
            ],
            [
                'attribute' => 'type',
                'format' => 'raw',
                'value' => function ($model) {
                    return Html::tag('i', $model->type_name, ['class'=>'text-warning']);
                },
                'filter' => $searchModel::typeList()
            ],
            // 'created_at',
            // 'updated_at',
            GridViewHelper::actionColumn([
                'title' => '操作',
                'template' => ['view', 'update', 'assign'],
                'item' => [
                    'view' => ['url' => 'view'],
                    'update' => ['url' => 'update'],
                    'assign' => ['url' => 'assign', 'attribute' => ['name']]
                ]
            ]),

        ],
    ]); ?>
</div>
>>>>>>> d0c4193369e4b589b30d4aed5efda89d4a6500d4
