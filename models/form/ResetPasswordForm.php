<?php
namespace kordar\ace\models\form;

use yii\base\Model;
use yii\base\InvalidParamException;
use kordar\ace\models\Admin;

/**
 * Password reset form
 */
class ResetPasswordForm extends Model
{
    public $password;
    public $repassword;

    /**
     * @var \kordar\ace\models\Admin
     */
    private $_user;


    /**
     * Creates a form model given a token.
     *
     * @param string $token
     * @param array $config name-value pairs that will be used to initialize the object properties
     * @throws \yii\base\InvalidParamException if token is empty or not valid
     */
    public function __construct($token, $config = [])
    {
        if (empty($token) || !is_string($token)) {
            throw new InvalidParamException('Password reset token cannot be blank.');
        }
        $this->_user = Admin::findByPasswordResetToken($token);
        if (!$this->_user) {
            throw new InvalidParamException('Wrong password reset token.');
        }
        parent::__construct($config);
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
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
            'password' => '密码',
            'repassword' => '重复密码'
        ];
    }

    /**
     * Resets password.
     *
     * @return bool if password was reset.
     */
    public function resetPassword()
    {
        $user = $this->_user;
        $user->setPassword($this->password);
        $user->removePasswordResetToken();

        return $user->save(false);
    }
}
