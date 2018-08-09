<?php
namespace kordar\ace\models\admin;

trait PersonalTrait
{
    public function getAvatar($baseUrl)
    {
        return $baseUrl . '/images/avatars/' . $this->avatar;
    }

    public function getName()
    {
        return empty($this->name) ? $this->username : $this->name;
    }
}