<?php

class PlaceController extends AdminController
{

    public function init()
    {
        parent::init();

        $this->menuActive = 'place';
        $this->pageTitle = Yii::app()->name . ' - Места';

        Yii::import('application.extensions.LocoTranslitFilter');
    }

    public function actionIndex()
    {
        $model = new Places();

        if (Yii::app()->request->isAjaxRequest) {
            $params = Yii::app()->request->getParam('Places');

            $model = new Places('search');
            $model->attributes = $params;
            $model->districtId = isset($params['districtId']) ? (int) $params['districtId'] : 0;
        }

        $districts = CHtml::listData(Districts::model()->findAll(), 'id', 'title_ru');
        $districts[-1] = Yii::t('main', 'Не указан');

        $categories = CHtml::listData(Categories::model()->findAll(), 'id', 'title_ru');

        $this->render('index', [
            'model' => $model,
            'districts' => $districts,
            'categories' => $categories,
        ]);
    }

    public function actionCreate()
    {
        $model = new Places('admin');

        if (Yii::app()->request->isAjaxRequest && 'addPlaceForm' == Yii::app()->request->getPost('ajax', '')) {
            $model->setAttributes(Yii::app()->request->getPost('Places', array()));

            echo CActiveForm::validate($model);

            Yii::app()->end();
        }

        $this->processForm($model);
    }

    public function actionUpdate()
    {
        $id = Yii::app()->request->getQuery('id', 0);

        $model = Places::model()->findByPk((int) $id);
        $model->scenario = Places::SCENARIO_ADMIN;

        if (Yii::app()->request->isAjaxRequest) {
            $model->setAttributes(Yii::app()->request->getPost('Places', array()));

            echo CActiveForm::validate($model);

            Yii::app()->end();
        }

        $this->processForm($model);
    }

    public function actionDelete()
    {
        if (Yii::app()->request->isAjaxRequest) {
            $id = Yii::app()->request->getQuery('id');

            $model = Places::model()->findByPk((int) $id);
            $photos = $model->photos;

            if ($model->delete()) {
                foreach ($photos as $photo) {
                    if (file_exists(Yii::app()->params['admin']['files']['images'] . $photo->title)) {
                        unlink(Yii::app()->params['admin']['files']['images'] . $photo->title);
                    }
                }
            }

            Yii::app()->user->setFlash('success', 'Место удалено');

            Yii::app()->end();
        }
    }

    public function actionUpload()
    {
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
        }

        $this->respondJSON($result);

        Yii::app()->end();
    }

    public function actionDeletePhoto()
    {
        $id = isset($_POST['id']) ? (int) $_POST['id'] : 0;

        $model = Photos::model()->findByPk($id);

        if ($model->delete()) {
            if (file_exists(Yii::app()->params['admin']['files']['images'] . $model->title)) {
                unlink(Yii::app()->params['admin']['files']['images'] . $model->title);
            }

            $this->respondJSON(true);
        }

        Yii::app()->end();
    }

    private function processForm(Places $model)
    {
        if (Yii::app()->request->isPostRequest) {
            $post = Yii::app()->request->getPost('Places', []);
            $postCategoryIds = $post['category_id'];
            $postPlacetags = Yii::app()->request->getPost('PlaceTags', []);
            $postPhotos = Yii::app()->request->getPost('Photos', []);

            $isNewRecord = $model->isNewRecord;
            $transaction = $model->dbConnection->beginTransaction();
            try {
                $oldCreatedAt = $model->created_at;
                $model->setAttributes($post);
                $model->created_at = Yii::app()->dateFormatter->format('yyyy-MM-dd HH:mm:ss', time());
                $model->alias = LocoTranslitFilter::cyrillicToLatin($model->title_ru);

                if ($isNewRecord) {
                    $model->created_at = $model->updated_at = Yii::app()->dateFormatter->format('yyyy-MM-dd HH:mm:ss', time());
                }
                else {
                    $model->created_at = Yii::app()->dateFormatter->format('yyyy-MM-dd HH:mm:ss', $oldCreatedAt);
                    $model->updated_at = Yii::app()->dateFormatter->format('yyyy-MM-dd HH:mm:ss', time());
                }

                if ($model->save()) {
                    if (!$model->tags) {
                        $model->tags = new PlaceTags();
                    }

                    $model->tags->place_id = $model->id;
                    $model->tags->tags = $postPlacetags;

                    if (!$model->tags->save(false)) {
                        Yii::app()->user->setFlash('error', 'Ошибка при добавлении тегов');
                    };

                    if ($postPhotos) {
                        $photoQuery = [];
                        foreach ($postPhotos as $photo) {
                            $photoQuery[] = '(' . $model->id . ', "' . $photo . '")';
                        }

                        $photoQueries = join(',', $photoQuery);
                        Yii::app()->db->createCommand('
                            INSERT INTO photos (place_id, title) VALUES ' . $photoQueries)->execute();
                    }

                    if ($postCategoryIds) {
                        PlacesCategories::model()->deleteAllByAttributes([
                                'place_id' => $model->id
                            ]);

                        foreach ($postCategoryIds as $id) {
                            $placesCategories = new PlacesCategories();
                            $placesCategories->place_id = $model->id;
                            $placesCategories->category_id = $id;

                            $placesCategories->save();
                        }
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
                    }

                    Yii::app()->user->setFlash('success', $isNewRecord ? 'Место добавлено' : 'Данные о месте изменены');

                    $this->redirect(Yii::app()->createUrl('/admin/place'));
                }
                else {
                    Yii::app()->user->setFlash('error', 'Ошибки при добалении Места');

                    $transaction->rollback();
                }
            }
            catch (Exception $e) {
                $transaction->rollback();
            }
        }

        $categories = CHtml::listData(Categories::model()->findAll(['order' => 'title_ru']), 'id', 'title_ru');
        $districts = CHtml::listData(Districts::model()->findAll(['order' => 'title_ru']), 'id', 'title_ru');

        $this->render('create', [
            'model' => $model,
            'categories' => $categories,
            'districts' => $districts,
        ]);
    }

}