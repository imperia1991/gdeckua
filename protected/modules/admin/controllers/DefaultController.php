<?php

class DefaultController extends AdminController
{
    public function filters()
    {
        return [
            'accessControl', // perform access control for CRUD operations
        ];
    }

    public function accessRules()
    {
        return [
            [
                'allow',
                'actions' => ['login', 'error'],
                'roles' => ['guest'],
            ],
            [
                'allow',
                'actions' => ['index', 'error', 'logout'],
                'roles' => ['admin'],
            ],
            [
                'deny', // deny all users
                'users' => ['*'],
            ],
        ];
    }

    public function init()
    {
        parent::init();

        $this->menuActive = 'index';
    }

    public function actionIndex()
    {
        $this->render('index');
    }

    public function actionLogin()
    {
        if (!Yii::app()->user->isGuest) {
            $this->redirect(Yii::app()->baseUrl . '/admin');
        }

        $this->modelUser->scenario = Users::SCENARIO_LOGIN;
        if (Yii::app()->request->isPostRequest && $post = Yii::app()->request->getPost(get_class($this->modelUser), [])) {
            $this->modelUser->setAttributes($post);
            if ($this->modelUser->validate() && $this->modelUser->login()) {
                $this->redirect(Yii::app()->baseUrl . '/admin');
            }
        }

        // display the login form
        $this->render('login', [
            'login' => true,
        ]);
    }

    /**
     * Logs out the current user and redirect to homepage.
     */
    public function actionLogout()
    {
        Yii::app()->user->logout();
        $this->redirect(Yii::app()->homeUrl);
    }
}