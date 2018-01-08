<?php
namespace kordar\ace\models\rbac;

use kordar\ace\web\helper\RbacHelper;
use yii\base\Model;
use yii\db\Exception;

class AssignModel extends Model
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

    public function setChildrenToRole($name)
    {
        $role = RbacHelper::getRole($name);
        if ($role instanceof \yii\rbac\Role && $this->validate()) {
            $trans = \Yii::$app->db->beginTransaction();
            try {
                if (RbacHelper::setChildrenToRole($role, $this->permissions, $this->roles)) {
                    $trans->commit();
                    return true;
                } else {
                    $trans->rollBack();
                }
            } catch (Exception $e) {}
        }
        return false;
    }

    public function setChildrenToUser($userId)
    {
        if ($this->validate()) {
            $trans = \Yii::$app->db->beginTransaction();
            try {
                if (RbacHelper::assign($userId, $this->permissions, $this->roles)) {
                    $trans->commit();
                    return true;
                } else {
                    $trans->rollBack();
                }
            } catch (Exception $e) {}
        }
        return false;
    }

}