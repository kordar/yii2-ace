<?php

namespace kordar\ace\models;

use Yii;
use yii\base\Exception;
use yii\helpers\ArrayHelper;

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
class Assignment extends Ace
{
    public $permissions = [];
    public $roles = [];


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['roles', 'permissions'], 'safe'],
            [['roles', 'permissions'], 'filter', 'filter'=>function($value){
                return empty($value) ? [] : $value;
            }],
        ];
    }

    public function permissions($userID)
    {
        $auth = Yii::$app->authManager;
        $this->permissions = array_keys($auth->getPermissionsByUser($userID));
        $permissions = $auth->getPermissions();
        $list = ArrayHelper::map($permissions, 'name', 'description');
        $cur = '';
        $data = [];
        foreach ($list as $key => $val) {
            $item = explode('/', $key);
            if ($cur != $item[0] . '|' . $item[1]) {
                $cur = $item[0] . '|' . $item[1];
            }
            $data[$cur][$key] = $val;
        }
        return $data;
    }

    public function roles($userID)
    {
        $auth = Yii::$app->authManager;
        $this->roles = array_keys($auth->getRolesByUser($userID));
        return ArrayHelper::map($auth->getRoles(), 'name', 'description');
    }

    public function setAssignment($userID)
    {
        $auth = Yii::$app->authManager;

        if ($this->validate()) {

            $items = ArrayHelper::merge($this->roles, $this->permissions);

            $trans = self::getDb()->beginTransaction();

            try {
                $auth->revokeAll($userID);
                foreach ($items as $child) {
                    $obj = empty($auth->getRole($child)) ? $auth->getPermission($child) : $auth->getRole($child);
                    $auth->assign($obj, $userID);
                }
                $trans->commit();
            } catch (Exception $e) {
                $trans->rollBack();
                return false;
            }
            return true;
        }

        return false;
    }

}
