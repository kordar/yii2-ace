<?php
namespace kordar\ace\helper;

use Yii;

class RedisHelper
{
    static $database = 0;

    static public function get($key)
    {
        /**
         * @var \yii\redis\Connection $redis
         */
        $redis = Yii::$app->redis;
        $redis->database = self::$database;
        return $redis->get($key);
    }

    static public function setEx($key, $ttl, $data)
    {
        /**
         * @var \yii\redis\Connection $redis
         */
        $redis = Yii::$app->redis;
        $redis->database = self::$database;
        return $redis->setex($key, $ttl, $data);
    }

    static public function set($key, $data)
    {
        /**
         * @var \yii\redis\Connection $redis
         */
        $redis = Yii::$app->redis;
        $redis->database = self::$database;
        return $redis->set($key, $data);
    }

}