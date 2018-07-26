<?php

namespace kordar\ace\models\menu;

use kordar\ace\models\admin\Admin;
use kordar\ace\web\libs\tree\GenerateTreeByArray;
use kordar\ace\web\libs\tree\MenuIterator;
use kordar\ace\models\Ace;
use yii\behaviors\BlameableBehavior;

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
            'value' => \Yii::$app->language
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
            'id' => \Yii::t('ace.menu', 'ID'),
            'title' => \Yii::t('ace.menu', 'Title'),
            'href' => \Yii::t('ace.menu', 'Href'),
            'parent_id' => \Yii::t('ace.menu', 'Parent ID'),
            'language' => \Yii::t('ace.menu', 'Language'),
            'icon' => \Yii::t('ace.menu', 'Icon'),
            'active' => \Yii::t('ace.menu', 'Active'),
            'sort' => \Yii::t('ace.menu', 'Sort'),
            'status' => \Yii::t('ace.menu', 'Status'),
            'hidden' => \Yii::t('ace.menu', 'Hidden'),
            'created_at' => \Yii::t('ace.menu', 'Created At'),
            'updated_at' => \Yii::t('ace.menu', 'Updated At'),
        ];
    }

    static public function sidebarData()
    {
        $dependency = new \yii\caching\DbDependency(['db'=>self::getDbSign(), 'sql'=>'SELECT MAX(updated_at) FROM {{%menu}}']);
        return self::find()->cache(3600, $dependency)->indexBy('id')->orderBy('sort DESC')->where(['language'=>\Yii::$app->language])->asArray()->all();
    }

    /**
     * @return array
     */
    static public function sidebarTree()
    {
        /**
         * @var $identity Admin
         */
        $identity = \Yii::$app->user->identity;

        if ($identity === null) {
            return [];
        }

        $isSuper = $identity->super();

        $data = self::sidebarData();

        $data = array_filter($data, function ($val) use($isSuper) {

            if (!$isSuper && $val['href'] !== '' && !\Yii::$app->user->can($val['href'])) {
                return false;
            }

            return true;
        });

        return (new GenerateTreeByArray())->tree($data);
    }

    /**
     * @return array
     */
    static public function setSidebarList()
    {
        $data = self::sidebarData();
        $tree = (new GenerateTreeByArray())->treeAll($data);

        $sideBarTree = new \RecursiveIteratorIterator(new MenuIterator($tree), \RecursiveIteratorIterator::SELF_FIRST);

        $list = [];
        foreach ($sideBarTree as $item) {
            $prefix = str_repeat('　', $sideBarTree->getDepth()) . '┗';
            $list[$item['id']] = $prefix . ' ' . $item['title'];
        }

        return $list;
    }

}
