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

        $this->render(
            'index',
            [
                'newsModel' => $newsModel,
                'categoriesModel' => $categoriesModel,
            ]
        );
    }

    /**
     *
     */
    public function actionCreate()
    {
        $newsModel = new News();

        $this->processForm($newsModel);
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
                    $image = new EasyImage($photoPath);
                    $image->resize(616, 386, EasyImage::RESIZE_PRECISE);

                    $directory = Yii::app()->params['admin']['files']['news'] . '/' ;
                    $image->save($directory . $newsModel->photo);

                    if (file_exists($photoPath)) {
                        unlink($photoPath);
                    }

                    if (file_exists($directory . $oldPhoto) && !empty($oldPhoto)) {
                        unlink($directory . $oldPhoto);
                    }
                }

                unset(Yii::app()->session['newsImage']);

                Yii::app()->user->setFlash('success', $isNewRecord ? 'Новость добавлена' : 'Новость изменена');

                $this->redirect($this->createUrl('/admin/news'));
            } else {
                Yii::app()->user->setFlash('error', 'Допущены ошибки при вводе новости. Исправьте их.');
            }
        }

        $categories = CHtml::listData(CategoryNews::model()->findAll(['order' => 'title_ru']), 'id', 'title_ru');

        $this->render(
            'form',
            [
                'newsModel' => $newsModel,
                'categories' => $categories,
            ]
        );
    }

    /**
     * Создание новости
     */
    public function actionUpdate()
    {
        $id = Yii::app()->request->getQuery('id', 0);

        $newsModel = News::model()->findByPk((int)$id);

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

    /**
     * Загрузка фото для анонса новости
     */
    public function actionUploadNewsPhoto()
    {
        $directory = Yii::app()->params['admin']['files']['news'] . '/' . date('dmY') . '/';
        $file = md5(date('YmdHis')) . '.' . pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);

        if (!file_exists($directory)) {
            mkdir($directory, 0777, true);
        }

        $array = [];
        if (move_uploaded_file($_FILES['file']['tmp_name'], $directory . $file)) {
            $array = [
                'filelink' => '/' . $directory . $file
            ];
        }

        $this->respondJSON($array);
    }

    /**
     * Загрузка файлов новости на сервер
     */
    public function actionUploadPhotos()
    {
        Yii::import("ext.EAjaxUpload.qqFileUploader");

        $uploader = new qqFileUploader(Yii::app()->params['admin']['images']['allowedExtensions'], Yii::app()->params['admin']['images']['sizeLimit']);
        $result = $uploader->handleUpload(Yii::app()->params['admin']['files']['tmp']);

        $photoPath = Yii::app()->params['admin']['files']['tmp'] . $result['filename'];

        $image = new EasyImage($photoPath, Yii::app()->easyImage->driver);

        $isWatermark = Yii::app()->session['toggleWatermark'];
        if ($isWatermark) {
            $mark = new EasyImage('/img/watermark.png', Yii::app()->easyImage->driver);
            $image->watermark($mark, -30, -30);
        }

        $directory = Yii::app()->params['admin']['files']['news'] . '/' . date('dmY') . '/';
        if (!file_exists($directory)) {
            mkdir($directory, 0775, true);
        }

        $image->resize(510, 340, EasyImage::RESIZE_AUTO);
        $image->save($directory . $result['filename']);

        if (file_exists($photoPath)) {
            unlink($photoPath);
        }

        unset($image);

        $result['filePath'] = '/' . $directory . $result['filename'];

        $this->respondJSON($result);
    }

    public function actionToggleWatermark() {
        Yii::app()->session['toggleWatermark'] = Yii::app()->getRequest()->getQuery('data', 0);

        $this->respondJSON([
                'response' => Yii::app()->session['toggleWatermark']
            ]);
    }
}