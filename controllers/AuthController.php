<?php
namespace kordar\ace\controllers;

use kordar\ace\models\form\LoginForm;
use kordar\ace\models\form\PasswordResetRequestForm;
use kordar\ace\models\form\ResetPasswordForm;
use kordar\ace\models\form\SignupForm;
use kordar\ace\web\helper\AppHelper;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;

/**
 * Class AuthController
 * layout is "login", error layout is "blank"
 * ACL and RBAC not included,
 * set errorAction to /ace/auth/error
 *
 * @package kordar\ace\controllers
 * @author Dehui Kong <572821520@qq.com>
 * @since 1.0
 * @item *:用户登录认证
 */
class AuthController extends AceController
{
    // layout
    public $layout = 'login';

    // acl validation is not included
    protected $except = ['login', 'signup', 'request-password-reset', 'reset-password', 'error'];

    // rbac validation is not included
    protected $rbacExcept = ['login', 'signup', 'request-password-reset', 'reset-password', 'error'];

    public function init()
    {
        \Yii::$app->errorHandler->errorAction = 'ace/auth/error';
        parent::init(); // TODO: Change the autogenerated stub
    }

    /**
     * Login action.
     * @desc 登录
     * @return string|\yii\web\Response
     * @item login:登录
     */
    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(\Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        return $this->render('login', [
            'model' => $model
        ]);
    }

    /**
     * Logout action.
     * @desc 注销
     * @return \yii\web\Response
     * @item logout:注销
     */
    public function actionLogout()
    {
        \Yii::$app->user->logout();
        return $this->goHome();
    }

    /**
     * Signs user up.
     * @desc 注册
     * @return string|\yii\web\Response
     * @item signup:注册
     */
    public function actionSignup()
    {
        $model = new SignupForm();

        if ($model->load(\Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (\Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        return $this->render('signup', [
            'model'=>$model
        ]);
    }

    /**
     * Request Password Reset
     * @desc 请求密码重置
     * @return string
     * @item request-password-reset:申请密码重置
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(\Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                AppHelper::setFlash('success', 'Please check your email for further instructions.');
            } else {
                AppHelper::setFlash('error', 'Sorry, we were unable to reset the password for the provided email.');
            }
        }

        return $this->render('forgot', [
            'model' => $model
        ]);
    }

    /**
     * Reset Password
     * @desc 重置密码
     * @param $token
     * @return string|\yii\web\Response
     * @throws BadRequestHttpException
     * @item reset-password:重置密码
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(\Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            AppHelper::setFlash('success', 'The new password is already stored.');
            return $this->goHome();
        }

        return $this->render('reset-password', [
            'model' => $model
        ]);
    }

    /**
     * @return string
     * @desc 登录异常
     * @item error:登录异常
     */
    public function actionError()
    {
        $exception = \Yii::$app->errorHandler->exception;
        if ($exception !== null) {
            $this->layout = 'blank';
            return $this->render('error',[
                'code' => $exception->getCode(),
                'message' => $exception->getMessage(),
            ]);
        }
    }

}