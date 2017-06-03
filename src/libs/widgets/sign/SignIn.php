<?php
namespace kordar\ace\widgets\sign;
use yii\base\Widget;

class SignIn extends Widget
{

    public $model;

    public function run()
    {
        return $this->render('index', [
            'view' => 'login',
            'model' => $this->model,
        ]);
    }

}
