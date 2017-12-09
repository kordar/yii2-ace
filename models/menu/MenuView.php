<?php

namespace kordar\ace\models\menu;

use Yii;

/**
 * This is the model class for table "{{%menu_view}}".
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
 * @property string $parent_title
 */
class MenuView extends Menu
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%menu_view}}';
    }

    public static function primaryKey()
    {
        return ['id'];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        $attributes = parent::attributeLabels();
        $attributes['parent_title'] = Yii::t('ace.menu', 'Parent Title');
        return $attributes;
    }
}
