<?php
namespace kordar\ace\models\admin;

use Yii;

/**
 * Signup Form
 */
class EditForm extends Admin
{
    public $password;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['email', 'name', 'password'], 'trim'],
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
            'password' => Yii::t('ace.admin', 'Password'),
        ];
    }

    /**
     * Signs user up.
     *
     * @return $user|null the saved model or null if saving fails
     */
    public function edit()
    {
        if (!$this->validate()) {
            return false;
        }
        if (!empty($this->password)) {
            $this->setPassword($this->password);
            $this->generateAuthKey();
        }
        return $this->save() ? true : false;
    }

}
