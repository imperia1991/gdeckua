<?php

class SiteController extends Controller
{

//    public function filters()
//    {
//        return array(
//            'accessControl', // perform access control for CRUD operations
//        );
//    }
//
//    public function accessRules()
//    {
//        return array(
//            array('allow',
//                'actions' => array('index', 'login', 'register', 'error'),
//                'roles' => array('guest'),
//            ),
//            array('allow',
//                'actions' => array('index', 'error', 'logout'),
//                'roles' => array('user', 'admin'),
//            ),
//            array('deny', // deny all users
//                'users' => array('*'),
//            ),
//        );
//    }

    /**
     * Declares class-based actions.
     */
    public function actions()
    {
        return array(
            // captcha action renders the CAPTCHA image displayed on the contact page
            'captcha' => array(
                'class' => 'CCaptchaAction',
                'backColor' => 0xFFFFFF,
            ),
            // page action renders "static" pages stored under 'protected/views/site/pages'
            // They can be accessed via: index.php?r=site/page&view=FileName
            'page' => array(
                'class' => 'CViewAction',
            ),
        );
    }

    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionIndex()
    {
        // renders the view file 'protected/views/site/index.php'
        // using the default layout 'protected/views/layouts/main.php'
        $this->render('index');
    }

    /**
     * This is the action to handle external exceptions.
     */
    public function actionError()
    {
        if ($error = Yii::app()->errorHandler->error) {
            if (Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render('error', $error);
        }
    }

    /**
     * Displays the contact page
     */
    public function actionContact()
    {
        $model = new ContactForm;
        if (isset($_POST['ContactForm'])) {
            $model->attributes = $_POST['ContactForm'];
            if ($model->validate()) {
                $name = '=?UTF-8?B?' . base64_encode($model->name) . '?=';
                $subject = '=?UTF-8?B?' . base64_encode($model->subject) . '?=';
                $headers = "From: $name <{$model->email}>\r\n" .
                    "Reply-To: {$model->email}\r\n" .
                    "MIME-Version: 1.0\r\n" .
                    "Content-Type: text/plain; charset=UTF-8";

                mail(Yii::app()->params['adminEmail'], $subject, $model->body, $headers);
                Yii::app()->user->setFlash('contact', 'Thank you for contacting us. We will respond to you as soon as possible.');
                $this->refresh();
            }
        }
        $this->render('contact', array('model' => $model));
    }

    /**
     * Displays the login page
     */
    public function actionLogin()
    {
        if (!Yii::app()->user->isGuest) {
            $this->redirect(Yii::app()->baseUrl . '/' . Yii::app()->getLanguage());
        }

        $this->modelUser->scenario = Users::SCENARIO_LOGIN;

        if (Yii::app()->request->isPostRequest && $post = Yii::app()->request->getPost(get_class($this->modelUser), array())) {
            $this->modelUser->setAttributes($post);
            if ($this->modelUser->validate() && $this->modelUser->login()) {
                $this->redirect(Yii::app()->baseUrl . '/' . Yii::app()->getLanguage());
            }
        }

        // display the login form
        $this->render('login', array(
            'login' => true,
        ));
    }

    /**
     * Displays the register page
     */
    public function actionRegister()
    {
        if (!Yii::app()->user->isGuest) {
            $this->redirect(Yii::app()->baseUrl . '/' . Yii::app()->getLanguage());
        }

        $this->modelUser->scenario = Users::SCENARIO_REGISTER;

        if (Yii::app()->request->isPostRequest) {
            $post = Yii::app()->request->getPost('Users', array());

            $this->modelUser->setAttributes($post);

            if ($this->modelUser->validate()) {
                if ($this->modelUser->save()) {
                    $this->modelUser->password = md5($post['password']);
                    $this->modelUser->save(false);

                    $this->modelUser->password = $post['password'];

                    $this->modelUser->login();

                    $this->redirect(Yii::app()->baseUrl . '/' . Yii::app()->getLanguage());
                }
            }
        }

        // display the login form
        $this->render('register', array(
            'register' => true,
        ));
    }

    public function actionForgot()
    {
        $this->modelUser->scenario = Users::SCENARIO_FORGOT;

        if (Yii::app()->request->isPostRequest && $post = Yii::app()->request->getPost(get_class($this->modelUser), array())) {
            $this->modelUser->setAttributes($post);
            if ($this->modelUser->validate()) {
                $this->redirect(Yii::app()->createUrl('/' . Yii::app()->getLanguage() . '/login'));
            }
        }

        $this->render('forgot', array());
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