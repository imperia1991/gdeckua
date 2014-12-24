<?php

/**
 * Class PhotoCityController
 */
class PhotoCityController extends AdminController
{
    /**
     *
     */
    public function init()
    {
        parent::init();

        $this->menuActive = 'photo';

        Yii::import('application.extensions.LocoTranslitFilter');
    }

    /**
     * Список новостей
     */
    public function actionIndex()
    {
        $photoCityModel = new PhotoCity('search');

        if (Yii::app()->request->isAjaxRequest) {
            $get = Yii::app()->request->getQuery('PhotoCity');

            $photoCityModel->setAttributes($get);
        }

        $this->render('index', [
                'photoCityModel' => $photoCityModel,
            ]);
    }


    /**
     * Добавление фото города / мероприятия
     */
    public function actionAdd()
    {
        $photoCityModel = new PhotoCity(PhotoCity::SCENARIO_ADMIN);

        $this->processForm($photoCityModel);
    }

    public function actionUpdate()
    {
        $id = Yii::app()->getRequest()->getQuery('id', 0);

        $photoCityModel = PhotoCity::model()->findByPk($id);
        $photoCityModel->scenario = PhotoCity::SCENARIO_ADMIN;

        $this->processForm($photoCityModel);
    }

    /**
     * Загрузка фото на странице
     */
    public function actionUpload()
    {
        Yii::import("ext.EAjaxUpload.qqFileUploader");

        $uploader = new qqFileUploader(Yii::app()->params['admin']['images']['allowedExtensions'], Yii::app(
        )->params['admin']['images']['sizeLimit']);
        $result = $uploader->handleUpload(Yii::app()->params['admin']['files']['tmp']);

        Yii::app()->session['photoCity'] = $result['filename'];

        $this->respondJSON($result);
    }

    /**
     * Удаление новости
     */
    public function actionDelete()
    {
        if (Yii::app()->request->isAjaxRequest) {
            $id = Yii::app()->request->getQuery('id');
            $photoCityModel = PhotoCity::model()->findByPk($id);

            if (file_exists(Yii::app()->params['admin']['files']['photoCity'] . $photoCityModel->photo)) {
                unlink(Yii::app()->params['admin']['files']['photoCity'] . $photoCityModel->photo);
            }

            PhotoCity::model()->deleteByPk((int)$id);

            Yii::app()->user->setFlash('success', 'Фотография удалена');

            Yii::app()->end();
        }
    }

    /** @var PhotoCity $photoCityModel */
    private function processForm($photoCityModel)
    {
        if (Yii::app()->getRequest()->isPostRequest) {
            $post = Yii::app()->getRequest()->getPost('PhotoCity', []);

            $isNewRecord = $photoCityModel->isNewRecord;
            $oldCreatedAt = $photoCityModel->created_at;
            $oldPhoto = $photoCityModel->photo;

            $photoCityModel->setAttributes($post);
            $photoCityModel->alias = LocoTranslitFilter::cyrillicToLatin($photoCityModel->title);

            if ($isNewRecord) {
                $photoCityModel->created_at = Yii::app()->dateFormatter->format('yyyy-MM-dd HH:mm:ss', time());
            }
            else {
                $photoCityModel->created_at = Yii::app()->dateFormatter->format('yyyy-MM-dd HH:mm:ss', $oldCreatedAt);
            }

            if ($photoCityModel->save()) {
                if ($oldPhoto != $photoCityModel->photo) {
                    $photoPath = Yii::app()->params['admin']['files']['tmp'] . $photoCityModel->photo;
                    $image = Yii::app()->image->load($photoPath);
                    $image->save(Yii::app()->params['admin']['files']['photoCity'] . $photoCityModel->photo);

                    if (file_exists($photoPath)) {
                        unlink($photoPath);
                    }
                }

                unset(Yii::app()->session['photoCity']);

                Yii::app()->user->setFlash(
                    'success',
                    Yii::t('main', 'Спасибо. Ваша фотография добавлена')
                );

                $this->redirect(Yii::app()->createUrl('/admin/photoCity'));
            } else {
                Yii::app()->user->setFlash('error', Yii::t('main', 'Вы допустили ошибки при добавлении фотографии'));
            }
        }

        $this->render('form', [
                'photoCityModel' => $photoCityModel
            ]);
    }

}