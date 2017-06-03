<?php
/**
 * Created by PhpStorm.
 * User: perpel
 * Date: 2017/5/7
 * Time: 15:24
 */
namespace kordar\ace\web;

use Yii;

class AceCache implements AdminCacheInterface
{
    static public function adminIdentityKey($adminID)
    {
        return self::ADMIN_NAVBAR_KEY . '_IDENTITY_KEY:' . $adminID;
    }

    static public function adminIdentityDel($adminID)
    {
        Yii::$app->cache->delete(AceCache::adminIdentityKey($adminID));
        Yii::$app->cache->delete(AceCache::ADMIN_NAVBAR_KEY);
    }

    static public function adminSiderBarDel()
    {
        Yii::$app->cache->delete(AceCache::ADMIN_SIDERBAR_KEY);
    }
}