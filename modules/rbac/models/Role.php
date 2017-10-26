<?php

namespace kordar\ace\modules\rbac\models;

use kordar\ace\models\Ace;
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
class Role extends Ace
{
    public $permissions = [];
    public $roles = [];

    public function createRole()
    {
        if ($this->validate()) {
            $auth = Yii::$app->authManager;
            $objRole = $auth->createRole($this->name);
            $objRole->description = $this->description;
            $objRole->ruleName = $this->rule_name;
            $objRole->data = $this->data;
            return $auth->add($objRole);
        }
        return false;
    }

    public function setChildren($name)
    {
        $auth = Yii::$app->authManager;
        $role = $auth->getRole($name);

        if (empty($role)) {
            return false;
        }

        if ($this->validate()) {

            $items = ArrayHelper::merge($this->roles, $this->permissions);

            $trans = self::getDb()->beginTransaction();

            try {
                $auth->removeChildren($role);
                foreach ($items as $child) {
                    $obj = empty($auth->getRole($child)) ? $auth->getPermission($child) : $auth->getRole($child);
                    $auth->addChild($role, $obj);
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

    // 获取所有权限列表
    public function getPermissions($name)
    {
        $auth = Yii::$app->authManager;
        $this->permissions = array_keys($auth->getPermissionsByRole($name));
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

    // 获取所有角色列表
    public function getRoles($name)
    {
        $auth = Yii::$app->authManager;
        $this->roles = array_keys($auth->getChildRoles($name));
        $roles = ArrayHelper::map($auth->getRoles(), 'name', 'description');
        ArrayHelper::remove($roles, $name);
        return $roles;
    }

}
