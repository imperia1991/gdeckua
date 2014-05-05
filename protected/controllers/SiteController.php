<?php

class SiteController extends Controller
{
    private static $countPhoto = 0;
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
                'backColor' => 0x494949,
				'foreColor' => 0xFFFFFF
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

    public function actionAdd()
    {
        $model = new Places(Yii::app()->getLanguage());

        if (Yii::app()->request->isPostRequest) {
            $post = Yii::app()->request->getPost('Places', array());

            $model->setAttributes($post);

            if ($model->save()) {
                Yii::app()->user->setFlash('success', 'Место добавлено');
                unset(Yii::app()->session['countImages']);
                unset(Yii::app()->session['images']);

                $this->redirect(Yii::app()->createUrl(Yii::app()->getLanguage() . '/'));
            } else {

            }
        }

        $title = 'title_' . Yii::app()->getLanguage();

        $districts = CHtml::listData(Districts::model()->findAll(), 'id', $title);
        $districts[-1] = Yii::t('main', 'Не указан');

        $this->render('place', array(
            'model' => $model,
            'districts' => $districts
        ));
    }

    public function actionUpload()
    {
        $countImages = isset(Yii::app()->session['countImages']) ? Yii::app()->session['countImages'] : 0;

        if ($countImages > 2) {
            $this->respondJSON(array('success' => false));
        } else {
            $countImages++;
            Yii::app()->session['countImages'] = $countImages;
        }

        Yii::import("ext.EAjaxUpload.qqFileUploader");

        $uploader = new qqFileUploader(Yii::app()->params['admin']['images']['allowedExtensions'], Yii::app()->params['admin']['images']['sizeLimit']);
        $result = $uploader->handleUpload(Yii::app()->params['admin']['files']['tmp']);

        $sessionImages = Yii::app()->session['images'];
        $sessionImages[] = $result['filename'];
        Yii::app()->session['images'] = $sessionImages;

        $this->respondJSON($result);
    }

    public function actionDeletePreviewUpload()
    {
        if (isset(Yii::app()->session['countImages'])) {
            $countImages = Yii::app()->session['countImages'];
            Yii::app()->session['countImages'] = $countImages - 1;
        }

        $request = Yii::app()->request;

        if (!$request->isAjaxRequest || !$request->isPostRequest) {
            Yii::app()->end();
        }

        $filename = $request->getPost('filename', '');

        $result = false;
        if ($filename && file_exists(Yii::app()->params['admin']['files']['tmp'] . $filename)) {
            $result = unlink(Yii::app()->params['admin']['files']['tmp'] . $filename);
        }

        $this->respondJSON($result);

        Yii::app()->end();
    }

}