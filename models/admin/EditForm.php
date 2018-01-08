<?php
namespace kordar\ace\models\admin;

use Yii;

/**
 * Signup Form
 */
class EditForm extends Admin
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['email', 'name'], 'trim'],
            [['email'], 'required'],
            [['email', 'name'], 'string', 'min' => 2, 'max' => 255],
            ['email', 'email'],

            ['email', 'unique'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'name' => Yii::t('ace.admin', 'Name'),
            'username' => Yii::t('ace.admin', 'Username'),
            'email' => Yii::t('ace.admin', 'Email'),
        ];
    }

}
