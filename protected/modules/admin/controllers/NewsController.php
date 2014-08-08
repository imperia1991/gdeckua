<?php

/**
 * Class NewsController
 */
class NewsController extends AdminController
{
    /**
     *
     */
    public function init()
    {
        parent::init();

        $this->menuActive = 'news';

        Yii::import('application.extensions.LocoTranslitFilter');
    }

    /**
     * Список новостей
     */
    public function actionIndex()
    {
        $newsModel = new News();
        $categoriesModel = new CategoryNews();

        if (Yii::app()->request->isAjaxRequest) {
            $get = Yii::app()->request->getQuery('News');

            $newsModel->setAttributes($get);
        }

        $this->render('index', [
                'newsModel' => $newsModel,
                'categoriesModel' => $categoriesModel,
            ]);
    }

    /**
     *
     */
    public function actionCreate()
    {
        $newsModel = new News();

        $this->processForm($newsModel);
    }

    /**
     * Создание новости
     */
    public function actionUpdate()
    {
        $id = Yii::app()->request->getQuery('id', 0);

        $newsModel = News::model()->findByPk((int) $id);

        $this->processForm($newsModel);
    }

    /**
     * Удаление новости
     */
    public function actionDelete()
    {
        if (Yii::app()->request->isAjaxRequest) {
            $id = Yii::app()->request->getQuery('id');

            News::model()->deleteByPk((int)$id);

            Yii::app()->user->setFlash('success', 'Новость удалена');

            Yii::app()->end();
        }
    }

    /**
     * Загрузка фото для анонса новости
     */
    public function actionUpload()
    {
        Yii::import("ext.EAjaxUpload.qqFileUploader");

        $uploader = new qqFileUploader(Yii::app()->params['admin']['images']['allowedExtensions'], Yii::app()->params['admin']['images']['sizeLimit']);
        $result = $uploader->handleUpload(Yii::app()->params['admin']['files']['tmp']);

        Yii::app()->session['newsImage'] = $result['filename'];

        $this->respondJSON($result);
    }

    /** @var News $newsModel */
    private function processForm($newsModel)
    {
        if (Yii::app()->request->isPostRequest) {
            $post = Yii::app()->request->getPost('News');
            $oldPhoto = $newsModel->photo;

            $newsModel->setAttributes($post);
            $newsModel->alias = LocoTranslitFilter::cyrillicToLatin($newsModel->title);

            $isNewRecord = $newsModel->isNewRecord;
            if ($newsModel->save()) {
                if ($oldPhoto != $newsModel->photo) {
                    $photoPath = Yii::app()->params['admin']['files']['tmp'] . $newsModel->photo;
                    $image = Yii::app()->image->load($photoPath);
                    $image->save(Yii::app()->params['admin']['files']['news'] . $newsModel->photo);

                    if (file_exists($photoPath)) {
                        unlink($photoPath);
                    }
                }

                unset(Yii::app()->session['newsImage']);

                Yii::app()->user->setFlash('success', $isNewRecord ? 'Новость добавлена' : 'Новость изменена');

                $this->redirect($this->createUrl('/admin/news'));
            } else {
                Yii::app()->user->setFlash('error', 'Допущены ошибки при вводе новости. Исправьте их.');
            }
        }

        $categories = CHtml::listData(CategoryNews::model()->findAll(array('order' => 'title_ru')), 'id', 'title_ru');

        $this->render('form', [
            'newsModel' => $newsModel,
            'categories' => $categories,
        ]);
    }
}