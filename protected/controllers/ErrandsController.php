<?php

class ErrandsController extends Controller
{

    public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }

    public function accessRules()
    {
        return array(
            array('allow',
                'actions' => array('index', 'create', 'error'),
                'roles' => array('guest'),
            ),
            array('allow',
                'actions' => array('index', 'create', 'update', 'delete', 'error'),
                'roles' => array('user', 'admin'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    /**
     * Declares class-based actions.
     */
    public function actions()
    {
        return array();
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

    public function actionCreate()
    {
        $model = new Promo();

        $this->processForm($model);
    }

    private function processForm($model)
    {
        $categories = CHtml::listData(Categories::model()->findAll(), 'id', 'title');

        $this->render('errand', array(
            'model' => $model,
            'categories' => $categories,
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