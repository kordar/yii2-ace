<?php
namespace kordar\ace\controllers;

use kordar\ace\filter\RbacFilter;
use yii\filters\VerbFilter;
use yii\web\Controller;

/**
 *  controller for the `ace` module
 */
class AceController extends Controller
{
    protected $actions = ['*'];
    protected $except = [];
    protected $mustlogin = [];
    protected $verbs = [
        'delete' => ['POST']
    ];

    public function behaviors()
    {
        return [
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                // 'user' => 'user',
                'only' => $this->actions,
                'except' => $this->except,
                'rules' => [
                    [
                        'allow' => false,
                        'actions' => $this->mustlogin,
                        'roles' => ['?'],
                    ],
                    [
                        'allow' => true,
                        'actions' => $this->mustlogin,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => $this->verbs,
            ],
            'rbac' => [
                'class' => RbacFilter::className()
            ]
        ];
    }


}
