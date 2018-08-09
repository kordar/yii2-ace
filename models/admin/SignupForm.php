<?php
namespace kordar\ace\models\admin;

use yii\base\Model;
use Yii;

/**
 * Signup Form
 */
class SignupForm extends Model
{
    public $name;
    public $username;
    public $email;
    public $password;
    public $confirmPassword;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'email', 'name'], 'trim'],
            [['username', 'email', 'password', 'confirmPassword'], 'required'],
            [['username', 'email', 'name'], 'string', 'min' => 2, 'max' => 255],
            [['password', 'confirmPassword'], 'string', 'min' => 6],
            ['email', 'email'],
            ['confirmPassword', 'compare', 'compareAttribute'=>'password', 'message'=> Yii::t('ace', 'The password is inconsistent twice')],

            ['username', 'unique', 'targetClass' => Admin::className(), 'message' => Yii::t('ace', 'This user is already in use')],
            ['email', 'unique', 'targetClass' => Admin::className(), 'message' => Yii::t('ace', 'This email is already registered')],
        ];
    }

    public function attributeLabels()
    {
        return [
            'name' => Yii::t('ace.admin', 'Name'),
            'username' => Yii::t('ace.admin', 'Username'),
            'email' => Yii::t('ace.admin', 'Email'),
            'password' => Yii::t('ace.admin', 'Password'),
            'confirmPassword' => Yii::t('ace.admin', 'Confirm Password')
        ];
    }

    /**
     * Signs user up.
     *
     * @return $user|null the saved model or null if saving fails
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
        $user = new Admin();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        
        return $user->save() ? $user : null;
    }
}
