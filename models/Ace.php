<?php
namespace kordar\ace\models;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

class Ace extends ActiveRecord
{
    public static function getDb()
    {
        $sign = self::getDbSign();
        return \Yii::$app->get($sign);
    }

    public static function getDbSign()
    {
        return \Yii::$app->get('ace', false) === null ? 'db' : 'ace';
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

}