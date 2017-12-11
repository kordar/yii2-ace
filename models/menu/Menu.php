<?php

namespace kordar\ace\models\menu;

use kordar\ace\helper\SidebarHelper;
use kordar\ace\libs\tree\GenerateTreeByArray;
use kordar\ace\libs\tree\MenuIterator;
use kordar\ace\models\Ace;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%menu}}".
 *
 * @property integer $id
 * @property string $title
 * @property string $href
 * @property integer $parent_id
 * @property string $language
 * @property string $icon
 * @property integer $active
 * @property integer $sort
 * @property integer $status
 * @property integer $hidden
 * @property integer $created_at
 * @property integer $updated_at
 */
class Menu extends Ace
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%menu}}';
    }

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
            [['parent_id', 'active', 'sort', 'status', 'hidden', 'created_at', 'updated_at'], 'integer'],
            [['title', 'language', 'icon'], 'string', 'max' => 255],
            [['href'], 'string', 'max' => 128],
            ['icon', 'default', 'value'=>'fa-circle-o'],
            [['sort', 'hidden', 'active'], 'default', 'value'=>0]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('ace.menu', 'ID'),
            'title' => Yii::t('ace.menu', 'Title'),
            'href' => Yii::t('ace.menu', 'Href'),
            'parent_id' => Yii::t('ace.menu', 'Parent ID'),
            'language' => Yii::t('ace.menu', 'Language'),
            'icon' => Yii::t('ace.menu', 'Icon'),
            'active' => Yii::t('ace.menu', 'Active'),
            'sort' => Yii::t('ace.menu', 'Sort'),
            'status' => Yii::t('ace.menu', 'Status'),
            'hidden' => Yii::t('ace.menu', 'Hidden'),
            'created_at' => Yii::t('ace.menu', 'Created At'),
            'updated_at' => Yii::t('ace.menu', 'Updated At'),
        ];
    }

    // 设置 Tree
    static public function sidebarTree()
    {
        $data = self::find()->indexBy('id')->orderBy('sort DESC')->where(['language'=>Yii::$app->language])->asArray()->all();
        $group = new GenerateTreeByArray();
        self::setSidebarList();
        return SidebarHelper::setTree($group->tree($data));
    }

    static public function setSidebarList()
    {
        $data = self::find()->select(['id', 'title', 'hidden', 'parent_id'])->indexBy('id')->orderBy('sort DESC')->asArray()->all();
        $group = new GenerateTreeByArray();
        $tree = $group->tree($data);
        $sideBarTree = new \RecursiveIteratorIterator(new MenuIterator($tree), \RecursiveIteratorIterator::SELF_FIRST);
        $list = [];
        foreach ($sideBarTree as $item) {
            $prefix = str_repeat('　', $sideBarTree->getDepth()) . '┗';
            $list[$item['id']] = $prefix . ' ' . $item['title'];
        }
        return SidebarHelper::setSidebarDropDownList($list);
    }

}
