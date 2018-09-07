<?php
namespace kordar\ace\web\widgets;

use kordar\ace\models\admin\Admin;
use yii\base\Widget;

class Navbar extends Widget
{

    public $baseUrl = '';

    public function run()
    {
        return $this->render('navbar/header', [
            'tools'=> [
                // 'tasks'=>$this->tasks()
            ],
            'personal' => $this->personal()
        ]);
    }

    protected function tasks()
    {
        return $this->render('navbar/tasks');
    }

    protected function bell()
    {
        return $this->render('navbar/bell');
    }

    protected function message()
    {
        return $this->render('navbar/message');
    }

    protected function personal()
    {
        /**
         * @var $identity Admin
         */
        $identity = \Yii::$app->user->identity;

        return $this->render('navbar/personal', ['avatar' => $identity->getAvatar($this->baseUrl), 'name' => $identity->getName()]);
    }

}