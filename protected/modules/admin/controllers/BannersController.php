<?php

/**
 * Class BannersController
 */
class BannersController extends AdminController
{
    /**
     *
     */
    public function init()
    {
        parent::init();

        $this->menuActive = 'banners';

        Yii::import('application.extensions.LocoTranslitFilter');
    }

    /**
     * Список банеров
     */
    public function actionIndex()
    {
        $bannerModel = new Banners();
        $categoriesModel = new Categories();

        if (Yii::app()->request->isAjaxRequest) {
            $get = Yii::app()->request->getQuery('Banners');

            $bannerModel = new Banners('search');

            $bannerModel->setAttributes($get);
        }

        $this->render('index', [
                'bannerModel' => $bannerModel,
                'categoriesModel' => $categoriesModel,
            ]);
    }

    /**
     *
     */
    public function actionCreate()
    {
        $bannerModel = new Banners();

        $this->processForm($bannerModel);
    }

    /**
     * Добавление банера
     */
    public function actionUpdate()
    {
        $id = Yii::app()->request->getQuery('id', 0);

        $bannerModel = Banners::model()->findByPk((int) $id);

        $this->processForm($bannerModel);
    }

    /**
     * Удаление банера
     */
    public function actionDelete()
    {
        if (Yii::app()->request->isAjaxRequest) {
            $id = Yii::app()->request->getQuery('id');
            
            Banners::model()->deleteByPk((int)$id);

            Yii::app()->user->setFlash('success', 'Банер удален');

            Yii::app()->end();
        }
    }

    /**
     * Загрузка изображения для банера
     */
    public function actionUpload()
    {
        Yii::import("ext.EAjaxUpload.qqFileUploader");

        $uploader = new qqFileUploader(Yii::app()->params['admin']['images']['allowedExtensions'], Yii::app()->params['admin']['images']['sizeLimit']);
        $result = $uploader->handleUpload(Yii::app()->params['admin']['files']['tmp']);

        Yii::app()->session['bannerImage'] = $result['filename'];

        $this->respondJSON($result);
    }

    /** @var Banners $bannerModel */
    private function processForm($bannerModel)
    {
        if (Yii::app()->request->isPostRequest) {
            $post = Yii::app()->request->getPost('Banners');
            $oldPhoto = $bannerModel->photo;

            $bannerModel->setAttributes($post);
            $bannerModel->categoriesStore = $post['categoriesStore'];

            $isNewRecord = $bannerModel->isNewRecord;
            if ($bannerModel->save()) {
                if ($oldPhoto != $bannerModel->photo) {
                    $photoPath = Yii::app()->params['admin']['files']['tmp'] . $bannerModel->photo;
                    $image = Yii::app()->image->load($photoPath);
                    $image->save(Yii::app()->params['admin']['files']['banners'] . $bannerModel->photo);

                    if (file_exists($photoPath)) {
                        unlink($photoPath);
                    }
                }

                unset(Yii::app()->session['bannerImage']);

                Yii::app()->user->setFlash('success', $isNewRecord ? 'Банер добавлен' : 'Банер изменен');

                $this->redirect($this->createUrl('/admin/banners'));
            } else {
                Yii::app()->user->setFlash('error', 'Допущены ошибки при вводе банера. Исправьте их.');
            }
        }

        $categories = CHtml::listData(Categories::model()->findAll(['order' => 'title_ru']), 'id', 'title_ru');

        $this->render('banner', [
            'bannerModel' => $bannerModel,
            'categories' => $categories,
        ]);
    }
}