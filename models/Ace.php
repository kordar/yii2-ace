<?php
namespace kordar\ace\models;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

class Ace extends ActiveRecord
{
    public static function getDb()
    {
        return \Yii::$app->get('ace', false) == null ? \Yii::$app->get('db') : \Yii::$app->get('ace');
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