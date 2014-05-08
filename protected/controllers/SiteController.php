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
            'dataProvider' => $dataProvider,
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
//        unset(Yii::app()->session['countImages']);
//        unset(Yii::app()->session['images']);

        if (Yii::app()->request->isPostRequest) {
            $post = Yii::app()->request->getPost('Places', array());
            $postPhotos = Yii::app()->request->getPost('Photos', array());

            $transaction = $model->dbConnection->beginTransaction();
            try{
                $model->setAttributes($post);
                $model->images = $postPhotos;
                $model->is_deleted = 1;

                if ($model->save()) {
                    if ($postPhotos) {
                        $photoQuery = array();
                        foreach ($postPhotos as $photo) {
                            $photoQuery[] = '(' . $model->id . ', "' . $photo . '")';
                        }

                        $photoQueries = join(',', $photoQuery);
                        Yii::app()->db->createCommand('
                            INSERT INTO photos (place_id, title) VALUES ' . $photoQueries)->execute();
                    }

                    $transaction->commit();

                    if ($postPhotos) {
                        foreach ($postPhotos as $photo) {
                            $photoPath = Yii::app()->params['admin']['files']['tmp'] . $photo;
                            $image = Yii::app()->image->load($photoPath);
                            $image->save(Yii::app()->params['admin']['files']['images'] . $photo);

                            if (file_exists($photoPath)) {
                                unlink($photoPath);
                            }
                        }

                        unset(Yii::app()->session['images']);
                        unset(Yii::app()->session['countImages']);
                    }

                    Yii::app()->user->setFlash('success', 'Место добавлено');

                    $this->redirect(Yii::app()->createUrl(Yii::app()->getLanguage() . '/'));
                } else {
                    Yii::app()->user->setFlash('error', 'Вы допустили ошибки при добавлении объекта');
    //                echo '<pre>';
    //                print_r($model->getErrors());
    //                echo '</pre>';
                }
            } catch (Exception $e) {
                $transaction->rollback();
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
        $request = Yii::app()->request;

        if (!$request->isAjaxRequest || !$request->isPostRequest) {
            Yii::app()->end();
        }

        $filename = $request->getPost('filename', '');

        $result = false;
        if ($filename && file_exists(Yii::app()->params['admin']['files']['tmp'] . $filename)) {
            $result = unlink(Yii::app()->params['admin']['files']['tmp'] . $filename);

            if (isset(Yii::app()->session['countImages'])) {
                $countImages = Yii::app()->session['countImages'];
                Yii::app()->session['countImages'] = $countImages - 1;
            }

            $imagesOld = $images = Yii::app()->session['images'];
            foreach ($images as $key => $image) {
                if ($filename == $image) {
                    unset($imagesOld[$key]);

                    break;
                }
            }

            Yii::app()->session['images'] = $imagesOld;
        }

        $this->respondJSON($result);

        Yii::app()->end();
    }

    public function actionFeedback()
    {
        $model = new Feedback();
        $model->setAttributes(Yii::app()->request->getPost('Feedback', array()));

        if ($model->save()) {
            $this->respondJSON(array(
                'error' => 0,
            ));
        } else {
            $this->respondJSON(array(
                'error' => 1,
                'errors' => $model->getErrors(),
            ));
        }

        Yii::app()->end();
    }

}