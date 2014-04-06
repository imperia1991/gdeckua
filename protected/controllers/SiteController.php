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

        $results = array();
        if ($model->search) {
            $controller = Yii::app()->createController('/search');
            $results = $controller[0]->search($model->search);

            $dataProvider = new CArrayDataProvider(
                    $results['results'],
                    array(
                        'pagination' => array(
                            'pageSize' => Yii::app()->params['pageSize'],
                        ),
                    )
            );
        }
        else {
            $dataProvider = $model->searchMain();
        }

        $this->render('index', array(
            'model' => $model,
            'search' => $model->search,
            'results' => $results,
            'dataProvider' => $dataProvider
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

    public function actionView()
    {
        $id = Yii::app()->request->getQuery('object', 0);
        $model = Places::model()->findByPk((int) $id);

        if (!is_object($model)) {
            throw new CHttpException(404, Yii::t('main', 'Такой объект не найден'));
        }

        $this->render('view', array(
            'model' => $model,
        ));
    }

}