<?php
namespace kordar\ace\models\form;

use kordar\ace\models\Admin;
use yii\base\Model;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $repassword;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\kordar\ace\models\Admin', 'message' => '该用户已被占用！'],
            ['username', 'string', 'min' => 2, 'max' => 255],
            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\kordar\ace\models\Admin', 'message' => '该邮箱已被注册！'],
            ['password', 'required'],
            ['password', 'string', 'min' => 6],

            ['repassword', 'required'],
            ['repassword', 'string', 'min' => 6],

            ['repassword', 'compare', 'compareAttribute'=>'password', 'message'=>'两次密码不一致']

        ];
    }

    public function attributeLabels()
    {
        return [
            'username' => '用户名',
            'email' => 'Email',
            'password' => '密码',
            'repassword' => '重复密码'
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
