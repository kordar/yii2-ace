<?php
namespace kordar\ace\controllers;

use kordar\ace\web\filter\RbacFilter;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;

/**
 *  controller for the `ace` module
 */
class AceController extends Controller
{
    protected $actions = ['*'];
    protected $except = [];
    protected $rbacExcept = [];
    protected $rbacJsonMessageOnly = [];
    protected $mustLogin = [];

    protected $verbs = [
        'delete' => ['POST']
    ];

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                // 'user' => 'user',
                'only' => $this->actions,
                'except' => $this->except,
                'rules' => [
                    [
                        'allow' => false,
                        'actions' => $this->mustLogin,
                        'roles' => ['?'],
                    ],
                    [
                        'allow' => true,
                        'actions' => $this->mustLogin,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => $this->verbs,
            ],
            'rbac' => [
                'class' => RbacFilter::className(),
                'except' => $this->rbacExcept,
                'jsonMessageOnly' => $this->rbacJsonMessageOnly
            ]
        ];
    }

    protected $closeCsrfValidate = ['upload'];

    public function beforeAction($action)
    {
        if(in_array($action->id, $this->closeCsrfValidate)) {
            $action->controller->enableCsrfValidation = false;
        }
        return parent::beforeAction($action);
    }

}
