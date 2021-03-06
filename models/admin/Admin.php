<?php
namespace kordar\ace\models\admin;

use Yii;
use kordar\ace\models\Ace;
use yii\web\IdentityInterface;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use kordar\ace\web\helper\ActiveFormHelper;

/**
 * User model
 *
 * @property integer $id
 * @property string $name
 * @property string $username
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property string $auth_key
 * @property integer $status
 * @property integer $type
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $password write-only password
 */
class Admin extends Ace implements IdentityInterface
{
    use PersonalTrait;

    public $status_name;
    public $type_name;

    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 10;

    const TYPE_SUPER = 9;
    const TYPE_NORMAL = 0;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%admin}}';
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
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_DELETED]],
        ];
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return bool
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function super()
    {
        return $this->type == self::TYPE_SUPER;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }

    public function attributeLabels()
    {
        return [
            'id' => Yii::t('ace.admin', 'ID'),
            'name' => Yii::t('ace.admin', 'Name'),
            'avatar' => Yii::t('ace.admin', 'Avatar'),
            'username' => Yii::t('ace.admin', 'Username'),
            'auth_key' => Yii::t('ace.admin', 'Auth Key'),
            'password_hash' => Yii::t('ace.admin', 'Password Hash'),
            'password_reset_token' => Yii::t('ace.admin', 'Password Reset Token'),
            'email' => Yii::t('ace.admin', 'Email'),
            'status' => Yii::t('ace.admin', 'Status'),
            'type' => Yii::t('ace.admin', 'Type'),
            'created_at' => Yii::t('ace', 'Created At'),
            'updated_at' => Yii::t('ace', 'Updated At'),
            'status_name' => Yii::t('ace.admin', 'Status Name'),
            'type_name' => Yii::t('ace.admin', 'Type Name'),
        ];
    }


    static public function statusList()
    {
        return [
            self::STATUS_DELETED => Yii::t('ace.admin', 'Delete'),
            self::STATUS_ACTIVE => Yii::t('ace.admin', 'Normal')
        ];
    }

    static public function typeList()
    {
        return [
            self::TYPE_NORMAL => Yii::t('ace.admin', 'Normal Admin'),
            self::TYPE_SUPER => Yii::t('ace.admin', 'Super Admin')
        ];
    }

    static public function extFieldsByCase()
    {
        return ActiveFormHelper::extSelectCase([
            'status' => ['alias' => 'status_name', 'items' => self::statusList()],
            'type' => ['alias' => 'type_name', 'items' => self::typeList()],
        ]);
    }

}