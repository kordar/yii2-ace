<?php
namespace kordar\ace\web\helper;

/***
 * Class AppHelper
 *
 * Application component public tools
 *
 * @package kordar\ace\web\helper
 * @author Dehui Kong <572821520@qq.com>
 * @since 1.0
 */
class AppHelper
{
    /**
     * @param $code
     * @param string $message
     * set Yii::$app->setFlash
     */
    public static function setFlash($code, $message = '')
    {
        \Yii::$app->session->setFlash($code, \Yii::t('ace.login', $message));
    }

}