<?php
namespace kordar\ace\controllers;

use kordar\ace\models\form\LoginForm;
use kordar\ace\models\form\PasswordResetRequestForm;
use kordar\ace\models\form\ResetPasswordForm;
use kordar\ace\models\form\SignupForm;
use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;

/**
 * Site controller
 * @item *:登录认证
 * @item login:登录
 * @item logout:注销
 * @item signup:注册
 * @item request-password-reset:申请密码重置
 * @item reset-password:重置密码
 */
class AuthController extends AceController
{
    public $layout = 'login';

    protected $except = ['login', 'signup', 'request-password-reset', 'reset-password'];

    protected $rbacExcept = ['login', 'signup', 'request-password-reset', 'reset-password'];

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        return $this->render('login', ['model' => $model]);
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }


    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }
        return $this->render('signup', ['model'=>$model]);
    }


    /**
     * Requests password reset.
     *
     * @return mixed
     * @desc 密码重置
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', '请查看您的电子邮件以获取进一步的说明.');
            } else {
                Yii::$app->session->setFlash('error', '很抱歉, 我们无法为提供的电子邮件重设密码.');
            }
        }

        return $this->render('forgot', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     * @desc 重置密码
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', '新的密码已经被存储.');

            return $this->goHome();
        }

        return $this->render('reset_password', [
            'model' => $model,
        ]);
    }

}
