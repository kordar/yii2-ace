<?php

namespace kordar\ace\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%sidebar}}".
 *
 * @property integer $id
 * @property string $title
 * @property string $src
 * @property integer $parent_id
 * @property string $language
 * @property integer $status
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
            [['parent_id', 'status', 'active', 'created_at', 'updated_at', 'sort'], 'integer'],
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
            'status' => 'set the sidebar status, the default 1 is active',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

}
