<?php

namespace kordar\ace\models;

use Yii;
use yii\behaviors\TimestampBehavior;
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
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
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
            'id' => 'ID',
            'title' => '菜单名',
            'href' => '链接',
            'parent_id' => '上级菜单',
            'language' => 'Language',
            'sort' => '排序',
            'icon' => '图标',
            'active' => '默认活动',
            'hidden' => '隐藏项',
            'status' => 'set the sidebar status, the default 1 is active',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function sidebarList()
    {
        $data = self::find()->select(['id', 'title'])->where(['hidden'=>0])->asArray()->all();
        return ArrayHelper::merge([0=>'无'], ArrayHelper::map($data, 'id', 'title'));
    }

}
