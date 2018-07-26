<?php

/* @var $this yii\web\View */
/* @var $user kordar\ace\models\Admin */

$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['/ace/auth/reset-password', 'token' => $user->password_reset_token]);
?>
Hello <?= $user->username ?>,

Follow the link below to reset your password:

<?= $resetLink ?>
