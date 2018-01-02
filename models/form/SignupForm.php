<?php
namespace kordar\ace\models\form;

use kordar\ace\models\admin\Admin;
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
    public $agreement;

    const AGREEMENT_OK = 1;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'email'], 'trim'],
            [['username', 'agreement', 'email', 'password', 'repassword'], 'required'],
            [['username', 'email'], 'string', 'min' => 2, 'max' => 255],
            ['agreement', 'in', 'range' => [self::AGREEMENT_OK]],
            ['email', 'email'],
            ['username', 'unique', 'targetClass' => Admin::className(), 'message' => \Yii::t('ace', 'This user is already in use')],
            ['email', 'unique', 'targetClass' => Admin::className(), 'message' => \Yii::t('ace', 'This email is already registered')],
            [['password', 'repassword'], 'string', 'min' => 6],
            ['repassword', 'compare', 'compareAttribute'=>'password', 'message'=>\Yii::t('ace', 'The password is inconsistent twice')]
        ];
    }

    public function attributeLabels()
    {
        return [
            'username' => \Yii::t('ace.login', 'Username'),
            'email' => \Yii::t('ace.login', 'Email'),
            'password' => \Yii::t('ace.login', 'Password'),
            'repassword' => \Yii::t('ace.login', 'confirmPassword'),
            'agreement' => \Yii::t('ace.login', 'User Agreement'),
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
