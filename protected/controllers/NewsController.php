<?php

/**
 * Class NewsController
 */
class NewsController extends Controller
{

    /**
     *
     */
    public function init()
    {
        parent::init();

        Yii::import('application.extensions.LocoTranslitFilter');
    }

    /**
     * Declares class-based actions.
     */
    public function actions()
    {
        return [
            // captcha action renders the CAPTCHA image displayed on the contact page
            'captcha' => [
                'class' => 'CCaptchaAction',
                'backColor' => 0x494949,
                'foreColor' => 0xFFFFFF
            ],
        ];
    }

    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionIndex()
    {
//
    }

    /**
     * This is the action to handle external exceptions.
     */
//    public function actionError()
//    {
//        if (isset($_GET['object'])) {
//            $id = Yii::app()->request->getQuery('object', 0);
//            if ($id) {
//                $placeModel = Places::model()->findByPk($id);
//
//                if ($placeModel) {
//                    $this->redirect(Yii::app()->createUrl('/' . Yii::app()->getLanguage() . '/view/' . $placeModel->id . '/' . $placeModel->alias));
//                }
//            }
//        }
//
//        if ($error = Yii::app()->errorHandler->error) {
//            if (Yii::app()->request->isAjaxRequest) {
//                echo $error['message'];
//            } else {
//                $this->render('/system/error' . $error['code'], $error);
//            }
//        }
//    }


    /**
     * @throws CHttpException
     */
    public function actionView()
    {
        $id = Yii::app()->request->getQuery('id', 0);

        /** @var News[] $newsModels  */
        $newsModels = News::model()->getViewNews($id);

        if (!is_array($newsModels)) {
            throw new CHttpException(404, Yii::t('main', 'Такая новость не найдена'));
        }

        /** @var News $prevNewsModel */
        $prevNewsModel = null;
        /** @var News $currentNewsModel */
        $currentNewsModel = null;
        /** @var News $nextNewsModel */
        $nextNewsModel = null;


        if (count($newsModels) == 3) {
            $prevNewsModel = $newsModels[0];
            $currentNewsModel = $newsModels[1];
            $nextNewsModel = $newsModels[2];
        } elseif (count($newsModels) == 2) {
            if ($id == $newsModels[1]->id) {
                $prevNewsModel = null;
                $currentNewsModel = $newsModels[1];
                $nextModels = $newsModels[0];
            } else {
                $prevNewsModel = $newsModels[1];
                $currentNewsModel = $newsModels[0];
                $newsModels = null;
            }
        } elseif (count($newsModels == 1)) {
            $prevNewsModel = null;
            $currentNewsModel = $newsModels[0];
            $nextNewsModel = null;
        }

        $this->render(
            'view',
            [
                'prevNewsModels' => $prevNewsModel,
                'currentNewsModel' => $currentNewsModel,
                'nextNewsModel' => $nextNewsModel,
            ]
        );
    }

}