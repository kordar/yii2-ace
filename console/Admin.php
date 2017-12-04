<?php
namespace kordar\ace\console;

class Admin
{
    public function createSuper($username, $password, $email = '')
    {
        $admin = new \kordar\ace\models\Admin();
        $email = empty($email) ? $username . '@ace.com' : $email;
        $admin->username = $username;
        $admin->email = $email;
        $admin->setPassword($password);
        $admin->generateAuthKey();
        $admin->type = 9;
        return $admin->save();
    }
}