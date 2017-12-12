<?php
namespace kordar\ace\helper;

use kordar\ace\libs\ArrayElementToGroup;
use yii\helpers\ArrayHelper;
use yii\rbac\Role;

class RbacHelper
{
    /**
     * 获取所有权限节点
     */
    public static function permissions()
    {
        return ArrayHelper::map(\Yii::$app->authManager->getPermissions(), 'name', 'description');
    }

    public static function permissionsByRole($role = '')
    {
        return array_keys(\Yii::$app->authManager->getPermissionsByRole($role));
    }

    public static function permissionsToGroup()
    {
        $iterator = new ArrayElementToGroup(RbacHelper::permissions(), function ($key) {
            return preg_match('/(\w+)\/(\w+)/', $key, $matches) ? $matches[0] : '';
        });

        $data = [];
        foreach ($iterator as $key => $val) {
            $data[$iterator->group][$key] = $val;
        }
        return $data;
    }

    public static function roles($name = '')
    {
        $roles = ArrayHelper::map(\Yii::$app->authManager->getRoles(), 'name', 'description');
        empty($name) ? null : ArrayHelper::remove($roles, $name);
        return $roles;
    }

    public static function rolesChild($role = '')
    {
        return array_keys(\Yii::$app->authManager->getChildRoles($role));
    }

    /**
     * @param $name
     * @return null|\yii\rbac\Role
     * 获取角色
     */
    public static function getRole($name)
    {
        return \Yii::$app->authManager->getRole($name);
    }

    /**
     * @param $name
     * @return null|\yii\rbac\Permission
     * 获取权限节点
     */
    public static function getPermission($name)
    {
        return \Yii::$app->authManager->getPermission($name);
    }

    /**
     * @param Role $role
     * @return bool
     * 清除角色下所有权限节点、包括子角色
     */
    public static function removeChildren(Role $role)
    {
        return \Yii::$app->authManager->removeChildren($role);
    }

    public static function setRoleChildren(Role $role, $children = [])
    {
        try {
            foreach ($children as $child) {
                \Yii::$app->authManager->addChild($role, RbacHelper::getRole($child));
            }
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    public static function setPermissionChildren(Role $role, $children = [])
    {
        try {
            foreach ($children as $child) {
                \Yii::$app->authManager->addChild($role, RbacHelper::getPermission($child));
            }
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * @param Role $role
     * @param array $permissions
     * @param array $roles
     * @return bool
     * 为角色指派权限节点
     */
    public static function setChildrenToRole(Role $role, $permissions = [], $roles = [])
    {
        RbacHelper::removeChildren($role);
        return RbacHelper::setPermissionChildren($role, $permissions) && RbacHelper::setRoleChildren($role, $roles);
    }

    public static function rolesByUser($userID)
    {
        return array_keys(\Yii::$app->authManager->getRolesByUser($userID));
    }

    public static function permissionsByUser($userID)
    {
        return array_keys(\Yii::$app->authManager->getPermissionsByUser($userID));
    }

    public static function revokeAll($userID)
    {
        \Yii::$app->authManager->revokeAll($userID);
    }

    public static function assign($userId, $permission = [], $roles = [])
    {
        RbacHelper::revokeAll($userId);
        return RbacHelper::assignPermissionChildren($userId, $permission) && RbacHelper::assignRoleChildren($userId, $roles);
    }

    public static function assignRoleChildren($userId, $children = [])
    {
        try {
            foreach ($children as $child) {
                \Yii::$app->authManager->assign(RbacHelper::getRole($child), $userId);
            }
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    public static function assignPermissionChildren($userId, $children = [])
    {
        try {
            foreach ($children as $child) {
                \Yii::$app->authManager->assign(RbacHelper::getPermission($child), $userId);
            }
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }


}