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
        );
    }

    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionIndex()
    {
        $model = new Places();
        $model->search = Yii::app()->request->getQuery('search', '');

        $this->render('index', array(
            'model' => $model,
        ));
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
}