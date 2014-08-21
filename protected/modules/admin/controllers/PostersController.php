<?php

/**
 * Class PostersController
 */
class PostersController extends AdminController
{
    /**
     *
     */
    public function init()
    {
        parent::init();

        $this->menuActive = 'poster';

        Yii::import('application.extensions.LocoTranslitFilter');
    }

    /**
     * Список афиш
     */
    public function actionIndex()
    {
        $postersModel = new Posters();
        $categoriesModel = new CategoryPosters();

        if (Yii::app()->request->isAjaxRequest) {
            $get = Yii::app()->request->getQuery('Posters');

            $postersModel->setAttributes($get);
        }

        $this->render('index', [
                'postersModel' => $postersModel,
                'categoriesModel' => $categoriesModel,
            ]);
    }

    /**
     *
     */
    public function actionCreate()
    {
        $posterModel = new Posters();

        $this->processForm($posterModel);
    }

    /**
     * Создание новости
     */
    public function actionUpdate()
    {
        $id = Yii::app()->request->getQuery('id', 0);

        $posterModel = Posters::model()->findByPk((int) $id);

        $this->processForm($posterModel);
    }

    /**
     * Удаление новости
     */
    public function actionDelete()
    {
        if (Yii::app()->request->isAjaxRequest) {
            $id = Yii::app()->request->getQuery('id');

            Posters::model()->deleteByPk((int)$id);

            Yii::app()->user->setFlash('success', 'Афиша удалена');

            Yii::app()->end();
        }
    }

    /**
     * Загрузка фото для афишы
     */
    public function actionUpload()
    {
        Yii::import("ext.EAjaxUpload.qqFileUploader");

        $uploader = new qqFileUploader(Yii::app()->params['admin']['images']['allowedExtensions'], Yii::app()->params['admin']['images']['sizeLimit']);
        $result = $uploader->handleUpload(Yii::app()->params['admin']['files']['tmp']);

        Yii::app()->session['posterImage'] = $result['filename'];

        $this->respondJSON($result);
    }

    /** @var Posters $posterModel */
    private function processForm($posterModel)
    {
        if (Yii::app()->request->isPostRequest) {
            $post = Yii::app()->request->getPost('Posters');
            $oldPhoto = $posterModel->photo;

            $posterModel->setAttributes($post);
            $posterModel->alias = LocoTranslitFilter::cyrillicToLatin($posterModel->title);

            $isNewRecord = $posterModel->isNewRecord;
            if ($posterModel->save()) {
                if ($oldPhoto != $posterModel->photo) {
                    $photoPath = Yii::app()->params['admin']['files']['tmp'] . $posterModel->photo;
                    $image = Yii::app()->image->load($photoPath);
                    $image->save(Yii::app()->params['admin']['files']['photoPoster'] . $posterModel->photo);

                    if (file_exists($photoPath)) {
                        unlink($photoPath);
                    }
                }

                unset(Yii::app()->session['posterImage']);

                Yii::app()->user->setFlash('success', $isNewRecord ? 'Афиша добавлена' : 'Афиша изменена');

                $this->redirect($this->createUrl('/admin/posters'));
            } else {
                Yii::app()->user->setFlash('error', 'Допущены ошибки при добавлении Афишы. Исправьте их.');
            }
        }

        $categories = CHtml::listData(CategoryPosters::model()->findAll(['order' => 'title_ru']), 'id', 'title_ru');

        $this->render('form', [
            'posterModel' => $posterModel,
            'categories' => $categories,
        ]);
    }
}