<?php

namespace kordar\ace\models;

use Yii;
use kordar\ace\helper\SidebarHelper;
use kordar\ace\libs\tree\GenerateTreeByArray;
use yii\behaviors\BlameableBehavior;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%sidebar}}".
 *
 * @property integer $id
 * @property string $title
 * @property string $src
 * @property integer $parent_id
 * @property string $language
 * @property integer $status
 * @property integer $hidden
 * @property integer $created_at
 * @property integer $updated_at
 */
class Sidebar extends Ace
{
    public $parent_title;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%sidebar}}';
    }

    /**
     * @inheritdoc
     */
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors[] = [
            'class' => BlameableBehavior::className(),
            'createdByAttribute' => 'language',
            'updatedByAttribute' => 'language',
            'value' => Yii::$app->language
        ];
        return $behaviors;
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['parent_id', 'status', 'active', 'sort', 'hidden'], 'integer'],
            [['title', 'language'], 'string', 'max' => 255],
            [['href'], 'string', 'max' => 128],
            [['icon'], 'string', 'max' => 36],
            ['icon', 'default', 'value'=>'fa-circle-o'],
            ['sort', 'default', 'value'=>0]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('ace.sidebar', 'ID'),
            'title' => Yii::t('ace.sidebar', 'Title'),
            'href' => Yii::t('ace.sidebar', 'Href'),
            'parent_id' => Yii::t('ace.sidebar', 'ParentID'),
            'parent_title' => Yii::t('ace.sidebar', 'Parent Title'),
            'language' => Yii::t('ace.sidebar', 'Language'),
            'sort' => Yii::t('ace.sidebar', 'Sort'),
            'icon' => Yii::t('ace.sidebar', 'Icon'),
            'active' => Yii::t('ace.sidebar', 'Active'),
            'hidden' => Yii::t('ace.sidebar', 'Hidden'),
            'status' => Yii::t('ace.sidebar', 'Status'),
            'created_at' => Yii::t('ace.sidebar', 'CreatedAt'),
            'updated_at' => Yii::t('ace.sidebar', 'UpdatedAt'),
        ];
    }

    public function sidebarList()
    {
        $data = self::find()->select(['id', 'title'])->where(['hidden'=>0])->asArray()->all();
        return ArrayHelper::merge([0=>'无'], ArrayHelper::map($data, 'id', 'title'));
    }

    // 设置 Tree
    static public function sidebarTree()
    {
        $data = self::find()->indexBy('id')->orderBy('sort DESC')->where(['language'=>Yii::$app->language])->asArray()->all();
        $group = new GenerateTreeByArray();
        return SidebarHelper::setTree($group->tree($data));
    }

    public function getParent()
    {
        return $this->hasOne(self::className(), ['id' => 'parent_id']);
    }

}
