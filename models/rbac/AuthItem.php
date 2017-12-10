<?php

namespace kordar\ace\models\rbac;

use Yii;
use kordar\ace\models\Ace;

/**
 * This is the model class for table "{{%auth_item}}".
 *
 * @property string $name
 * @property integer $type
 * @property string $description
 * @property string $rule_name
 * @property resource $data
 * @property integer $created_at
 * @property integer $updated_at
 */
class AuthItem extends Ace
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%auth_item}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['type'], 'integer'],
            [['description', 'data'], 'string'],
            [['name', 'rule_name'], 'string', 'max' => 64],
            ['type', 'default', 'value'=>0],
            ['rule_name', 'default', 'value'=>null],
            ['data', 'default', 'value'=>null],
            [['rule_name'], 'exist', 'skipOnError' => true, 'targetClass' => AuthRule::className(), 'targetAttribute' => ['rule_name' => 'name']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'name' => Yii::t('ace.rbac', 'Item Name'),
            'type' => Yii::t('ace.rbac', 'Item Type'),
            'description' => Yii::t('ace.rbac', 'Item Description'),
            'rule_name' => Yii::t('ace.rbac', 'Item Rule Name'),
            'data' => Yii::t('ace.rbac', 'Item Data'),
            'created_at' => Yii::t('ace', 'Created At'),
            'updated_at' => Yii::t('ace', 'Updated At'),
        ];
    }

}
