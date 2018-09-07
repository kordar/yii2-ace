<?php
namespace kordar\ace\web\helper;

use kordar\ace\models\Ace;
use kordar\ace\models\admin\Admin;

class LoggerHelper
{
    public static function setLogger($data)
    {
        Ace::getDb()->createCommand()->insert('{{%operate_logger}}', $data)->execute();
    }

    public static function writeLogger($logger = '')
    {
        if (empty($logger)) {
            return false;
        }

        /**
         * @var $identity Admin
         */
        $identity = \Yii::$app->user->identity;

        if (!empty($identity)) {
            $data = [
                'name' => $identity->getName(), 'ip' => \Yii::$app->request->getUserIP(),
                'url' => \Yii::$app->request->url, 'desc' => $logger, 'created_at' => time()
            ];
            self::setLogger($data);
        }

        return true;
    }

}